<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function showWebsite()
    {
        $website = Website::with('subscribers', 'post')->paginate(10);
        return response()->json($website);
    }
    public function createWebsite(Request $request)
    {
        $request->validate([
            'url' => ['required', 'max:255']
        ]);
        $url = $request->url;
        $title = $request->title;
        $description = $request->description;
        if (Website::select()->where('url', $url)->exists()) {
            return 'Your site is subscribed to';
        } else {
            Website::create([
                'url' => $url,
                'title' => $title,
                'description' => $description
            ]);
        }
        return 'Your website subscribed';
    }
}
