<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     *  Authencating user for login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where("email", $data['email'])->first;
        if (!$user || Hash::check($data['password'], $user->password)) {
            return response([
                'message' => "Invalid login credential"
            ], 403);
        }

        return response([
            "user" => $user,
            "token" => $user->createToken("mcq")->plainTextToken
        ], 201);
    }
}
