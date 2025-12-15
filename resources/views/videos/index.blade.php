@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Video List</h1>
        <a href="{{ route('videos.create') }}" class="btn btn-primary mb-3">Upload New Video</a>
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="card-text">Duration: {{ $video->duration ?? 'N/A' }} seconds</p>
                            <a href="{{ route('video.watch', ['id' => $video->id])  }}" class="btn btn-success">Watch Video</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection