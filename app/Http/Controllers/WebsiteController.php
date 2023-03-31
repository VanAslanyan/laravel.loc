<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsiteRequest;
use App\Models\Website;

class WebsiteController extends Controller
{
    public function showWebsite()
    {
        $website = Website::with('subscribers', 'post')->paginate(10);
        return response()->json($website);
    }

    public function createWebsite(StoreWebsiteRequest $request)
    {
        $request->validated();
        $url = $request->url;
        $title = $request->title;
        $description = $request->description;
        if (Website::query()->select()->where('url', $url)->exists()) {
            return 'Your site is subscribed to';
        } else {
            Website::query()->create([
                'url' => $url,
                'title' => $title,
                'description' => $description
            ]);
        }
        return 'Your website subscribed';
    }
}
