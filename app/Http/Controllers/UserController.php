<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function showUsers()
    {
        $user = User::with('subscribeUser')->get();
        return response()->json($user);
    }


    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255']
        ]);
        $name = $request->name;
        $email = $request->email;
        if (User::select('email')->where('email', $email)->exists()) {
            return 'Your email is already exists';
        } else {
            $user = User::create([
                'email' => $email,
                'name' => $name,
            ]);
        }
        if (!$user) {
            return abort(404);

        }
    }


}
