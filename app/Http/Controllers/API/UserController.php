<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    /**
     * Login user function
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        try {

            // Validate request
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Find user by email
            $user = User::where('email', $request->email)->firstOrFail();
            if (!Hash::check($request->password, $user->password)) {
                throw new Exception('Invalid password');
            }

            // Generate token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Login successful');
        } catch (Exception $e) {

            // Return error
            return ResponseFormatter::error($e->getMessage());
        }
    }

    /**
     * Register user function
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        try {

            // Validate request
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', new Password],
            ]);

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Generate token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Register success');
        } catch (Exception $error) {

            // Return error response
            return ResponseFormatter::error($error->getMessage());
        }
    }

    /**
     * Logout user function
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        // Revoke Token
        $token = $request->user()->currentAccessToken()->delete();

        // Return Response
        return ResponseFormatter::success($token, 'Logout success');
    }

    /**
     * Get user function
     *
     * @param Request $request
     * @return void
     */
    public function fetch(Request $request)
    {
        // Get user
        $user = $request->user();

        // Return response
        return ResponseFormatter::success($user, 'Fetch success');
    }
}
