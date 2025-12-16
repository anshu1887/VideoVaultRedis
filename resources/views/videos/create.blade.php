@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Upload Video</h1>
        <div class="row">
            <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Video title" required><br><br>
                <input type="file" name="video" accept="video/mp4" required><br><br>
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
@endsection
