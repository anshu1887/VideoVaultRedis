@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-semibold mb-4">Edit Video</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('video.update', ['id' => $video->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-[#0b0b0b] p-6 rounded shadow">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <label class="block">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Title</span>
                <input type="text" name="title" required value="{{ old('title', $video->title) }}" class="mt-1 block w-full rounded-md border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0b0b0b] px-3 py-2">
            </label>

            <label class="block">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Replace video (optional)</span>
                <input type="file" name="video" accept="video/mp4,video/avi,video/quicktime" class="mt-1 block w-full">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current file.</p>
            </label>

            <div class="mt-2">
                <h3 class="text-sm font-medium mb-2">Current Video</h3>
                <div class="aspect-video bg-black">
                    <video class="w-full h-full object-cover" controls preload="metadata">
                        <source src="{{ Storage::url('videos/' . $video->filename) }}" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded">Save Changes</button>
                <a href="{{ route('videos.watch', $video->id) }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
            </div>
        </div>
    </form>
</div>

@endsection
