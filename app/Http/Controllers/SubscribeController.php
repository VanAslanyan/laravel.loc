<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeRequest;
use App\Models\Subscriber;

class SubscribeController extends Controller
{

    public function showSubscribes()
    {
        $allSubscribers = Subscriber::with('user')->paginate(10);
        return response()->json($allSubscribers);
    }

    public function createSubscribe(StoreSubscribeRequest $request)
    {
        $request->validated();
        $userId = $request->user_id;
        $websiteId = $request->website_id;

        if (Subscriber::where('website_id', $websiteId)->where('user_id', $userId)->exists()) {
            return 'your emails is already exists';
        } else {
              Subscriber::create([
                'user_id' => $userId,
                'website_id' => $websiteId,
            ]);

        }
        return 'Your  subscribe accepted';
    }
}
