@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-semibold mb-4">Upload New Video</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-[#0b0b0b] p-6 rounded shadow">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <label class="block">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Title</span>
                <input type="text" name="title" required value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0b0b0b] px-3 py-2" placeholder="Enter a descriptive title">
            </label>

            <label class="block">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Video File</span>
                <input type="file" name="video" accept="video/mp4" required class="mt-1 block w-full">
                <p class="text-xs text-gray-500 mt-1">Max 200MB. Supported: mp4</p>
            </label>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded">Upload</button>
                <a href="{{ route('videos.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
            </div>
        </div>
    </form>
</div>

@endsection
