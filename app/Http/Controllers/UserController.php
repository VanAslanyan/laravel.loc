<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function showUsers()
    {
        $user = User::with('subscribeUser')->paginate(10);
        return response()->json($user);
    }


    public function createUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'min:5', 'max:255']
        ]);
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
            return abort(404,'');
        }
        return 'Your user subscribed';
    }
}
