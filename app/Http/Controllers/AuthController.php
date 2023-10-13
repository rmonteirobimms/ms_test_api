<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use ApiResponseTrait;
    /**
     * Function used to register new users. 
     * 
     * Needs to be here for separation of concerns reasons. 
     * May require atypical data validation or extra steps for verification
     * 
     * @param UserPostRequest $request
     * 
     * @return Illuminate\Http\Response
     */
    public function register(UserPostRequest $request)
    {
        $validated = $request->validated();
        $data["user"] = User::create($validated);

        if (!$data["user"]) {
            return $this->sendError("Error creating new User. Please, try again later.");
        }

        return $this->sendResponse($data, "User created sucessfully.", 201);
    }

    /**
     * Function used to login users. 
     * 
     * Validates the request and checks for an email. If provided it will take precedence over the username (will be ignored). 
     * If found a profile with the given email, the user_id associated with the profile will used for a user lookup.
     * If no email is provided, the user lookup will use the (unique) username.
     * If the credentials match a token will be generated and returned to the user.
     * 
     * @param LoginRequest $request
     * 
     * @return Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (array_key_exists('email', $validated)) {
            $profile = Profile::where('email', $validated['email'])->first();

            if (!$profile) {
                return $this->sendFail($validated['email'], "Wrong credentials.", 401);
            }

            $identifier = 'id';
            $value = $profile->user_id;
        } else {
            $identifier = 'username';
            $value = $validated['username'];
        }

        $user = User::where($identifier, $value)->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return $this->sendFail($user, "Wrong credentials.", 401);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        $data = [
            'token' => $token,
            'Type' => 'Bearer'
        ];

        return $this->sendResponse($data, "Login successful.", 200);
    }

    /**
     * Function used to logout users. 
     * 
     * Checks if user is authenticated and deletes the token from the database.
     * 
     * @return Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $data["result "] = $request->user()->currentAccessToken()->delete();

        return $this->sendResponse($data, "Logout successful.", 200);
    }
}
