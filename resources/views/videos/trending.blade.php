@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Trending Videos</h1>
        <a href="{{ route('videos.index') }}" class="text-sm text-gray-600 hover:underline">See all</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($videos as $entry)
            @php($v = $entry['video'] ?? null)
            @if($v)
            <article class="bg-white dark:bg-[#0f0f0f] rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                <a href="{{ route('videos.watch', $v->id) }}" class="block">
                    <div class="aspect-video bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                        <img src="{{ asset('images/placeholder2.svg') }}" alt="thumbnail" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-semibold truncate">{{ $v->title }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ number_format($entry['views'] ?? 0) }} views</p>
                    </div>
                </a>
            </article>
            @endif
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">No trending videos found.</div>
        @endforelse
    </div>
</div>

@endsection