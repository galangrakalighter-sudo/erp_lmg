<?php

namespace App\Services;
use Google\Client;
use Google\Service\YouTube;
use Google\Service\YouTubeAnalytics;

class YoutubeService
{
    protected string $token;
    protected $client;
    /**
     * Mengambil media dengan penambahan Timeout 120 detik
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');
        
        // Menambahkan Scope untuk Data (Video List) dan Analytics (Reach)
        $this->client->addScope(YouTubeAnalytics::YT_ANALYTICS_READONLY);
        $this->client->addScope(YouTube::YOUTUBE_READONLY);
    }

    public function getAnalyticsReport($since = null, $until = null, $accessToken)
    {
        $this->client->setAccessToken($accessToken);
        $isiTokenSekarang = $this->client->getAccessToken();
        // dd($isiTokenSekarang);
        $analytics = new \Google\Service\YouTubeAnalytics($this->client);

        $params = [
            'ids' => 'channel==MINE',
            'startDate' => '2025-01-01',
            'endDate' => date('Y-m-d'),
            'metrics' => 'impressions,views,likes',
            'dimensions' => 'day'
        ];
    }
}