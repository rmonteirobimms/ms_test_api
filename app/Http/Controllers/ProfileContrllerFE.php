<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePostRequest;
use App\Http\Requests\ProfilePutRequest;
use App\Models\Profile;
use App\Models\TempFile;
use Illuminate\Http\Request;

class ProfileContrllerFE extends Controller
{
    // Show all profiles
    public function index(Request $request)
    {
        //dd(Profile::where('user_id', auth()->user()->id)->get());
        $profiles = Profile::where('user_id', auth()->user()->id)->get();
        //dd(Profile::where('user_id', auth()->user()->id)->get());
        return view('profiles.index', [
            'description' => 'Have a look at our profiles!',
            'profiles' => $profiles
        ]);
    }

    // Show single profile
    public function show(Profile $profile)
    {
        return view('profiles.show', [
            'profile' => $profile
        ]);
    }

    // Show create form 
    public function create()
    {
        return view("profiles.create");
    }

    // Saves create form 
    public function store(ProfilePostRequest $request)
    {
        $profile = $request->validated();

        /*$profile = Profile::create([
            'user_id' => $profile['user_id'],
            'email' => $profile['email'],
            'name' => $profile['name'],
            'imageURL' => $profile['imageURL']
        ]);*/
        $profile = Profile::create($profile);

        $tempFile = TempFile::where('folder', $request->imageURL)->first();

        if ($tempFile) {
            $profile->addMedia(storage_path('app/avatars/tmp/' . $request->imageURL . '/' . $tempFile->filename))
                ->toMediaCollection('avatars');

            rmdir(storage_path('app/avatars/tmp/' . $request->imageURL));
            $tempFile->delete();
        }

        return redirect('profiles')
            ->with('msg', 'profile created successfully!');
    }

    // Show edit form
    public function edit(Profile $profile)
    {
        return view("profiles.edit", ["profile" => $profile]);
    }

    // Update profile
    public function update(ProfilePutRequest $request, profile $profile)
    {
        $updatedInfo = $request->validated();

        $profile->update($updatedInfo);

        return view('profiles.show', [
            'profile' => $profile
        ])->with('message', 'profile updated successfully!');
    }


    // Delete profile
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect('profiles')
            ->with('message', 'profile deleted successfully!');
    }
}
