<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserPutRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["users"] = User::all();
        $users_count = count($data["users"]);

        if(!$users_count){
            // Usually sendFail would apply here, but there is no data to return
            return $this->sendError("No users were found.", 404);
        }
        
        return $this->sendResponse($data, "Found $users_count user(s).");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request)
    {
        $validated = $request->validated();

        $data["user"] = User::create($validated);

        if(!$data["user"]){
            return $this->sendError("Error creating new user. Please, try again later.");
        }

        return $this->sendResponse($data, "User created sucessfully.", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data["user"] = User::find($id);

        if(!$data["user"]){
            return $this->sendFail($id, "Couldn't find a user with the id: {$id}.", 404);
        }

        return $this->sendResponse($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPutRequest $request, string $id)
    {
        $validated_request = $request->validated();
        $data["user"]  = User::find($id);

        if(!$data["user"] ){
            return $this->sendFail($id, "Couldn't find a user with the id: {$id}.", 404);
        }

        $username = $data["result"]->username;

        if($data["user"]->update($validated_request) === false){
            return $this->sendError("Error updating the user with id: {$id}.");
        }

        return $this->sendResponse($data, "User '{$username}' updated sucesssfully", 200);
    }

    /**
     * Remove the specified resource from storage. Only softdeletes
     */
    public function destroy(string $id)
    {
        $data["result"] = User::find($id);

        if(!$data["result"]){
            return $this->sendFail($id, "Couldn't find a user with the id: {$id}.", 404);
        }

        $username = $data["result"]->username;

        if($data["result"]->delete() == false){
            return $this->sendError("Error deleting the user with id: {$id}.");
        }

        return $this->sendResponse($data, "User '{$username}' deleted sucesssfully", 200);
    }

    /**
     * Restore the specified users. Only works on softdeletes
     */
    public function restore(string $resource, string $id)
    {
        $class_name = ucwords(strtolower(trim($resource)));
        $full_class_name = "App\Models\\{$class_name}";

        if(!class_exists($full_class_name)){
            return $this->sendFail([$resource, $id], "Couldn't find resource '{$resource}'.", 404);
        }

        $model = app($full_class_name);

        $object_to_restore = $model::withTrashed()->find($id);

        if(!$object_to_restore){
            return $this->sendFail([$resource, $id], "Couldn't find '{$resource}' with id: {$id}.", 404);
        }

        $data["restored"] = $object_to_restore->restore();

        if(!$data["restored"]){
            return $this->sendError("Error restoring '{$resource}' with id: {$id}.");
        }

        return $this->sendResponse($data, "'{$resource}' «{$id}» was restored successfully.");
    }
}
