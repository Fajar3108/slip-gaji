<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid Login',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Success'
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'User updated successfuly',
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        if (!isset($request->current_password) || !Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'The provided password does not match your current password.'
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return response()->json([
            'message' => 'User updated password successfuly'
        ]);
    }
}
