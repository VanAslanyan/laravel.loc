<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{

    public function showSubscribes()
    {
        $allSubscribers = Subscriber::with('user')->paginate(10);
        return response()->json($allSubscribers);
    }

    public function createSubscribe(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'website_id' => ['required'],
        ]);
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
