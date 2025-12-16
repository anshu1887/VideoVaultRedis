<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Services\RedisVideoService;

class VideoController extends Controller
{
    protected $redisService;

    public function __construct(RedisVideoService $redisService) {
        $this->redisService = $redisService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('videos.index', ['videos' => Video::all()]);
    }

    public function trending()
    {
        $trendings = $this->redisService->trending();

        $videos = [];
        foreach ($trendings as $id => $score) {
            $videos[] = [
                'video' => Video::find($id),
                'views' => $this->redisService->getViews($id)
            ];
        }

        return view('videos.trending', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4|max:204800' // max 200MB,
        ]);

        $path = $request->file('video')->store('videos', 'public');

        $video = Video::create([
            'title' => $request->input('title'),
            'filename' => basename($path),
        ]);

        return redirect()->route('videos.watch', $video->id)->with('success', 'Video uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $video = $this->redisService->getVideo($id);
        $views = $this->redisService->incrementViews($id);

        $this->redisService->addToTrending($id);

        return view('videos.watch', ['video' => \json_decode($video), 'views' => $views]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('videos.edit', ['video' => Video::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,avi,mov|max:204800' // max 200MB,
        ]);

        $video = Video::findOrFail($id);
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', 'public');
            if(file_exists(storage_path('app/public/videos/' . $video->filename)))
                unlink(storage_path('app/public/videos/' . $video->filename));
        } else {
            $path = 'videos/' . $video->filename;
        }
        $video->update([
            'title' => $request->input('title'),
            'filename' => basename($path),
        ]);

        return redirect()->route('videos.watch', $video->id)->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
