<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{

    public function showWebsite()
    {
        $website = Website::with('subscribers', 'post')->get();
        return response()->json($website);
    }


    public function createWebsite(Request $request)
    {
        $validate = $request->validate([
           'url' => ['required','max:255']
        ]);
        $url = $request->url;
        $title = $request->title;
        $description = $request->description;

        if (Website::select()->where('url', $url)->exists()) {
            return 'Your website subscribed';
        } else {
            $post = Website::create([
                'url' => $url,
                'title' => $title,
                'description' => $description
            ]);
        }
    }


}
