<?php

namespace App\Http\Controllers;

use App\Console\Commands\sendEmail;
use App\Jobs\SendingEmail;
use App\Mail\EmailForm;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscriber;

//use http\Client\Curl\User ;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function showPosts()
    {
        $post = Post::all();
        return response()->json($post);
    }


    public function createPost(Request $request)
    {
        $website_id = $request->website_id;
        $website = Website::select()->where('id', '=', $website_id)->first();
        $website_name = parse_url($website->url, PHP_URL_HOST);
        $title = $request->title;
        $description = $request->description;
        if (Website::where('id', $website_id)->exists()) {
            $post = Post::create([
                'website_id' => $website_id,
                'title' => $title,
                'description' => $description,
            ]);
        } else {
            return 'Website is not exists';
        }

    }
}
