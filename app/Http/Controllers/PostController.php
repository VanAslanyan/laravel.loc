<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return response()->json($post);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $website_id = $request->website_id;
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
        if ($post) {
            $subscribers = Subscriber::select()->where('website_id', '=', $website_id)->get();
            $chunkSubscribers = $subscribers->chunk(100);
            foreach ($chunkSubscribers as $subscriber) {
                foreach ($subscriber as $users)
                    $user = User::select()->where('id', $users->user_id)->get();
                $data = array(
                    'title' => $title,
                    'description' => $description,
                );
                dispatch(new SendingEmail($user, $data));
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
