<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class VerifyEmailController extends Controller
{
    public function verifyUser(Request $request)
    {
        try {
            // Decrypt the token to get the email
            $email = Crypt::decryptString($request->token);

            // Find the user with this email
            $user = User::where('email', $email)->first();

            \Log::info($user);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->is_verified = 1;
            $user->save();

            \Log::info($user);

            return redirect()->route('login');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }
    }
}
