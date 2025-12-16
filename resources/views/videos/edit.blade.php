@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Uploaded Video</h1>
        <div class="row">
            <h2>Upload Video</h2>
            <form class="form-group w-50" action="{{ route('video.update', ['id' => $video->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="form-control my-2" type="text" name="title" placeholder="Video title" required value="{{ $video->title }}">
                <input class="form-control my-2" type="file" name="video" accept="video/mp4" required>
                <button class="btn btn-primary" type="submit">Upload</button>
                <p><h2>Current Video:</h2></p>
                <video width="720" controls preload="metadata">
                    <source src="{{ storage_path('/videos/' . $video->filename) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </form>
        </div>
    </div>
@endsection
