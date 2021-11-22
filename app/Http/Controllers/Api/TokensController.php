<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    public function __invoke() {
        $clients = Client::where("active", true)->get();

        $response = [];

        foreach($clients as $client) {
            $response['addr'][$client->ip_addr] = true;
            $response['token'][$client->short_url] = $client->ip_addr;
            $response['ch'][$client->short_url] = $client->ch;

        }

        return response()->json($response);
        
    }
}
