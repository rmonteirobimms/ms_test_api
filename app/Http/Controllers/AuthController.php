<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserPostRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Function used to register new users. 
     * 
     * Needs to be here for separation of concerns reasons. 
     * May require atypical data validation or extra steps for verification
     * 
     * @param UserPostRequest $request
     * 
     * @return JsonResponse
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
     * @param LoginRequest $request
     * 
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (array_key_exists('email', $validated)) {
            $profile = Profile::where('email', $validated['email']);
            $identifier = 'id';
            $value = $profile['id'];
        } else {
            $identifier = 'username';
            $value = $validated['username'];
        }

        $user = User::where($identifier, $value)->first();
    }
}
