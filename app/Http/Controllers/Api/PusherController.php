<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Laravel\PusherManager;

class PusherController extends Controller
{
    private $pusher;

    public function __construct(PusherManager $pusher)
    {
        $this->pusher = $pusher;
    }

    public function auth(Request $request)
    {
        return $this->pusher->socket_auth($request->channel_name, $request->socket_id);
    }
}
