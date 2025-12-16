@extends('layouts.app')

@section('content')

<?php 
{{--  dd($video);  --}}
?>

    <div class="container">
        <h1>Video List</h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <p><strong>Views:</strong> {{ $views }}</p>
                        <video width="720" controls preload="metadata">
                            <source src="{{ Storage::url('videos/' . $video->filename) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <p>Uploaded at: {{ date('d M Y', strtotime($video->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
