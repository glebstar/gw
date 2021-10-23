<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function signin(SigninRequest $request): JsonResponse
    {
        $attr = $request->validated();

        if (!Auth::attempt($attr)) {
            return response()->json([
                'error' => 'Credentials not match',
            ], 401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }
}
