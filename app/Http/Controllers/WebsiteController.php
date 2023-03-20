<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $website = Website::with('subscribers', 'post')->get();
        return response()->json($website);
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

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function mailSend ($subscribe_id){
//        if ($post) {
//            $data = array(
//                'name' => $url,
//                'title' => $title,
//                'description' => $description,
//            );
//            $subUser = Subscriber::select('email')->where('id', '!=', $subscribe_id)->get();

//            foreach ($subUser as $recipient) {
//                Mail::send('emails.email', $data, function ($m) use ($recipient) {
//                    $m->to($recipient)->subject('new subscriber website');
//
//                });
//            }
//            return response()->json(['success' => 'Send emails successfully.']);

//        } else {
//            return false;
//        }
//
//
//
//    }
    public
    function destroy(string $id)
    {
        //
    }
}
