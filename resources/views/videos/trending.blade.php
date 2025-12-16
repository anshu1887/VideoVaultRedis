@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trending Videos</h1>
        @foreach ($videos as $video)
            @if ($video['video'])
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video['video']->title }}</h5>
                        <p class="card-text">Views: {{ $video['views'] }}</p>
                        <a href="{{ route('videos.watch', $video['video']->id) }}" class="btn btn-primary">Watch</a>
                    </div>
                </div>
            @else
                <p> No trending video found </p>
            @endif
        @endforeach
    </div>
@endsection