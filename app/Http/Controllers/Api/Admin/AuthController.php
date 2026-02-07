<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $service
    ) {}

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
            'password'     => ['required', 'string'],
        ]);

        $user = $this->service->login($request->only('phone_number', 'password'));

        if (! $user) {
            return \ResponseMessage('Invalid credentials', 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'data'  => $user,
        ]);
    }
}
