<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     *  Authencating user for login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                return $this->responseSuccess([
                    "user" => $user,
                    "token" => $user->createToken("mcq")->plainTextToken
                ], 'Logged In Successfully !');
            }
            return $this->responseError(null, 'Invalid Email and Password !');
        } catch (\Exception $e) {
            return $this->responseError(null, "Unknown Error !!!", JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     *  User Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->responseSuccess([], 'Logout Success');
    }
}
