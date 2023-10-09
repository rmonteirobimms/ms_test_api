<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserPostRequest;

class AuthControllerFE extends Controller
{
    public function create() //FE
    {
        return view("users.register");
    }

    // Creates user
    public function store(UserPostRequest $request)
    {
        $user = $request->validated();

        $user = User::create($user);

        auth()->login($user);

        return redirect('/')
            ->with('message', 'User created successfully!');
    }

    // Logs user out
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('message', 'User logged out!');
    }

    // Show login form
    public function login_form()
    {
        return view("users.login");
    }

    // Log user in
    public function login(LoginRequest $request)
    {
        //$user = $request->getCredentials();

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
            return back()
                ->withErrors(['email' => 'Invalid Credentials'])
                ->onlyInput('email');
        }

        auth()->login($user);

        return redirect('/')
            ->with('message', 'You are now logged in!');
    }
}
