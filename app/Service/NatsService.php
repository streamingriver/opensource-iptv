<?php

namespace App\Service;

use App\Models\Channel;
use Illuminate\Support\Facades\Http;

class NatsService {

    public static function update() {
        $ffmpeg = Channel::where("ffmpeg", true)->get();
        $cache = [];

        $response = [
            'videoffmpeg' => [],
            'videocache' => [],
        ];

        foreach($ffmpeg as $f) {
            $response['videoffmpeg'][] = [
                'url' => $ffmpeg->stream_url,
                'name' => $ffmpeg->uuid,
            ];
        }

        $message = json_encode($response);
        self::send($message);
    }


    public static function send($message) {
        $topic = env("NATS_TOPIC", "super-config");
        $natsServer = env("NATS_PROXY", "http://sr-nats-proxy");

        $url = sprintf("%s?topic=%s", $natsServer, $topic);

        Http::withHeaders([
            'Content-Type'=>"text/plain"
        ])
        ->withBody($message, 'text/plain')
        ->post($url);
    }
}