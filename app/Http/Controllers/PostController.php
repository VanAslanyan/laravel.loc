<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPosts()
    {
        $post = Post::paginate(10);
        return response()->json($post);
    }


    public function createPost(Request $request)
    {
        $request->validate([
            'website_id' => ['required'],
            'title' => ['required', 'min:1', 'max:255'],
            'description' => ['required', 'min:1', 'max:255']
        ]);
        $websiteId = $request->website_id;
        Website::select()->where('id', '=', $websiteId)->first();
        $title = $request->title;
        $description = $request->description;
        if (Website::where('id', $websiteId)->exists()) {
            Post::create([
                'website_id' => $websiteId,
                'title' => $title,
                'description' => $description,
            ]);
        } else {
            return 'Website is not exists';
        }
        return 'Post is posted';
    }
}
