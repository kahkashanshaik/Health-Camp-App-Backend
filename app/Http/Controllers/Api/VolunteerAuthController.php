<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VolunteerLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class VolunteerAuthController extends Controller
{
    public function login(VolunteerLoginRequest $request) {
        if(Auth::attempt($request->only('email', 'password')) && Auth::user()->role === 'volunteer') {
            $user = User::find(Auth::user()->id);
            unset(
                $user->password,
                $user->remember_token,
                $user->created_at,
                $user->updated_at,
                $user->email_verified_at
            );
            return response()->json([
                'message' => 'Successfully signed up',
                'user' => $user,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Please check your credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        $token = explode(' ', $request->header('authorization'));
        $isTokenExists = PersonalAccessToken::findToken($token[1]);
        if (!isset($token) || empty($isTokenExists)) {
            return response()->json([
                "message" => "Token are not set in headers / Token Expired",
                "status" => "failure"
            ], Response::HTTP_UNAUTHORIZED);
        }
        $member = $isTokenExists->tokenable;
        $member->tokens()->delete();
        return response()->noContent();
    }
}
