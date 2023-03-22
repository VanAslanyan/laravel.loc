<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class SubscribeController extends Controller
{

    public function showSubscribes()
    {
        $sub = Subscriber::all();
        return response()->json($sub);
    }



    public function createSubscribe(Request $request)
    {

        $user_id = $request->user_id;
        $website_id = $request->website_id;

        if (Subscriber::where('website_id', $website_id)->where('user_id', $user_id)->exists()) {
            return 'your emails is already exists';
        } else {
            $subscribe = Subscriber::create([
                'user_id' => $user_id,
                'website_id' => $website_id,
            ]);
            if (!$subscribe) {
                return abort(404);
            }
        }
    }


}
