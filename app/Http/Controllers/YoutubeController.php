<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\YouTube;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function getVideoData($videoId)
    {
        // 1. Inisialisasi Google Client
        $client = new Client();
        $client->setDeveloperKey(config('services.youtube.api_key'));

        // 2. Inisialisasi Service YouTube
        $youtube = new YouTube($client);

        try {
            // 3. Panggil API untuk mendapatkan snippet (judul/deskripsi) dan statistics (view count)
            $response = $youtube->videos->listVideos('snippet,statistics', [
                'id' => $videoId
            ]);

            // Cek jika video ditemukan
            if (empty($response->getItems())) {
                return response()->json(['error' => 'Video tidak ditemukan'], 404);
            }

            $video = $response->getItems()[0];

            return response()->json([
                'judul' => $video->snippet->title,
                'view_count' => $video->statistics->viewCount,
                'like_count' => $video->statistics->like_count ?? 0,
                'channel' => $video->snippet->channelTitle
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}