<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Video;
use Illuminate\Support\Facades\Storage;

// Get the first video
$video = Video::first();

if ($video) {
    echo "Video ID: " . $video->id . "\n";
    echo "Video Title: " . $video->title . "\n";
    echo "Video Filename: " . $video->filename . "\n";
    echo "Storage URL: " . Storage::url('videos/' . $video->filename) . "\n";
    echo "Full URL: " . config('app.url') . Storage::url('videos/' . $video->filename) . "\n";

    // Check if file exists
    $filePath = storage_path('app/public/videos/' . $video->filename);
    echo "File exists: " . (file_exists($filePath) ? 'Yes' : 'No') . "\n";
    echo "File path: " . $filePath . "\n";
} else {
    echo "No videos found in database\n";
}
