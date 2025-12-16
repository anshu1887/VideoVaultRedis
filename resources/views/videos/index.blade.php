@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between py-6">
        <h1 class="text-2xl font-semibold">All Videos</h1>
        <a href="{{ route('videos.create') }}" class="inline-flex items-center px-4 py-2 bg-black text-white rounded-md shadow"><x-icon-upload class="mr-2 w-4 h-4"/>Upload New Video</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($videos as $video)
            <article class="bg-white dark:bg-[#0f0f0f] rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <a href="{{ route('videos.watch', $video->id) }}" class="block">
                    <div class="aspect-video bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                        <video class="w-full h-full object-cover" muted playsinline preload="metadata">
                            <source src="{{ Storage::url('videos/' . $video->filename) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="p-4">
                        <h2 class="font-medium text-sm truncate">{{ $video->title }}</h2>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">Duration: {{ $video->duration ?? 'N/A' }} • Uploaded {{ $video->created_at->diffForHumans() }}</div>
                    </div>
                </a>
                <div class="p-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div class="text-xs text-gray-500">Views: {{ $video->views ?? '—' }}</div>
                    <div class="flex gap-2">
                        <a href="{{ route('videos.edit', $video->id) }}" class="text-sm px-3 py-1 border border-gray-200 rounded hover:bg-gray-50"><x-icon-edit class="mr-2 w-4 h-4"/>Edit</a>
                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Delete this video?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm px-3 py-1 bg-red-50 text-red-700 border border-red-100 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">No videos uploaded yet.</div>
        @endforelse
    </div>
</div>

@endsection