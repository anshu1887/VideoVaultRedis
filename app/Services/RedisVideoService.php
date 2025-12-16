<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Models\Video;

Class RedisVideoService {
    public static function cacheVideo(Video $video) {
        Redis::hmset("Video:{$video->id}", [
            'id' => $video->id,
            'title' => $video->title,
            'filename' => $video->filename,
        ]);

        // Set an expiration time of 1 hour
        Redis::expire("Video:{$video->id}", 3600);
    }

    public static function getVideo($id) {
        if(Redis::exists("Video:$id")) {
            return Redis::hgetall("Video:$id");
        }

        $video = Video::findOrFail($id);
        Self::cacheVideo($video);

        return json_encode($video);
    }

    public static function incrementViews($id) {
        return Redis::incr("Video:$id:views");
    }

    public static function getViews($id) {
        return Redis::get("Video:$id:views") ?? 0;
    }

    // Add video to trending (Sorted Set)
    public static function addToTrending($id) {
        return Redis::zincrby('trending_videos', 1, $id);
    }

    // Get top trending videos
    public static function trending($limit = 10) {
        return Redis::zrevrange('trending_videos', 0, $limit - 1);
    }
}