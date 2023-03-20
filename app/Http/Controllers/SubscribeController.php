<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub = Subscriber::all();
        return response()->json($sub);
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
