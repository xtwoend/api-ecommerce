<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, ['endpoint' => 'required']);
        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->key,
            $request->token
        );
    }

    public function destroy(Request $request)
    {
        $this->validate($request, ['endpoint' => 'required']);
        $request->user()->deletePushSubscription($request->endpoint);
        return response()->json(null, 204);
    }
}
