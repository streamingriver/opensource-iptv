<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Client;
use Illuminate\Http\Request;

class GetChannelController extends Controller
{
    public function __invoke($url, $uuid) {
        $channel = Channel::UUID($uuid)->firstOrFail();

        $client = Client::URL($url)->firstOrFail();

        $client->update([
            'ip_addr'=>request()->server("REMOTE_ADDR"),
            'ch' => $uuid,
        ]);
        
        $response = "#EXTM3U\n";
        $response .= "#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=2024000\n";
        $response .= sprintf("%s/streams/%s/%s/stream.m3u8", env("APP_URL"), $url, $channel->uuid);
        
        return response($response, 200, array('Content-Type' => 'text/plain'));
    }
}
