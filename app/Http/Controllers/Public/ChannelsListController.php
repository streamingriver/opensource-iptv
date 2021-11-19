<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ChannelsListController extends Controller
{
    public function __invoke($uuid) {

        $client = Client::with("channels")->URL($uuid)->firstOrFail(); 

        $client->update(['ip_addr'=>request()->server("REMOTE_ADDR")]);

        $list = $client->channels->mapWithKeys(function($item, $key) use ($client) {
            return [$key=>['name'=>$item->name, 'url'=>env("APP_URL").'/i/get/'.$client->short_url.'/'.$item->uuid,'epg'=>$item->epg1]];
        });

        $template = "#EXTINF:-1 tvg-id=\"%s\",%s\n%s\n";

        $response = "#EXTM3U\n";
        foreach($list as $channel) {
            $response .= sprintf($template, $channel['epg'], $channel['name'], $channel['url']);
        }

        return response($response, 200, array('Content-Type' => 'text/plain'));
    }
}
