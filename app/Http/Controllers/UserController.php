<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{

    public function showUsers()
    {
        $user = User::with('subscribeUser')->paginate(10);
        return response()->json($user);
    }


    public function createUser(StoreUserRequest $request)
    {
        $request->validated();
        $name = $request->name;
        $email = $request->email;
        if (User::select('email')->where('email', $email)->exists()) {
            return 'Your email is already exists';
        } else {
            $user = User::query()->create([
                'email' => $email,
                'name' => $name,
            ]);
        }
        if (!$user) {
            return 'us';
        }
        return 'Your user subscribed';
    }
}
