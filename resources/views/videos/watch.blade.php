@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('videos.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Back to videos</a>
    </div>

    <div class="bg-white dark:bg-[#0b0b0b] rounded-lg shadow overflow-hidden">
        <div class="aspect-video bg-black">
            <video class="w-full h-full object-cover" controls preload="metadata">
                <source src="{{ Storage::url('videos/' . $video->filename) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="p-6">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <h1 class="text-lg font-semibold">{{ $video->title }}</h1>
                    <p class="text-xs text-gray-500 mt-1">{{ number_format($views ?? 0) }} views • Uploaded {{ isset($video->created_at) ? 
                        \Carbon\Carbon::parse($video->created_at)->diffForHumans() : 'unknown' }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('videos.edit', $video->id) }}" class="text-sm px-3 py-1 border border-gray-200 rounded hover:bg-gray-50"><x-icon-edit class="mr-2 w-4 h-4"/>Edit</a>
                    <a href="{{ Storage::url('videos/' . $video->filename) }}" download class="text-sm px-3 py-1 bg-gray-100 rounded"><x-icon-download class="mr-2 w-4 h-4"/>Download</a>
                </div>
            </div>

            <div class="mt-4 text-gray-700 dark:text-gray-300">
                @if(!empty($video->description))
                    <p>{{ $video->description }}</p>
                @else
                    <p class="text-sm text-gray-500">No description provided.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Comments / related placeholder --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <h2 class="text-sm font-medium mb-3">Comments</h2>
            <div class="p-4 bg-white dark:bg-[#0b0b0b] rounded shadow">Comments coming soon.</div>
        </div>
        <aside class="p-4 bg-white dark:bg-[#0b0b0b] rounded shadow">
            <h3 class="text-sm font-medium mb-2">More from uploader</h3>
            <p class="text-xs text-gray-500">Related videos and suggestions will appear here.</p>
        </aside>
    </div>
</div>

@endsection
