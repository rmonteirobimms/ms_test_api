<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait GenericCrudTrait {

    /**
     * Get the model class for this controller.
     *
     * @return string
     */
    abstract protected function getModel();

    /**
     * Get the model class name for this controller.
     *
     * @return string
     */
    abstract protected function getModelName();

    /**
     * Get the store request for this controller.
     *
     * @return string
     */
    abstract protected function getPostValidationRules();

    /**
     * Get the update request for this controller.
     *
     * @return string
     */
    abstract protected function getPutValidationRules();

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class_name = $this->getModelName();
        $data[$class_name] = $this->getModel()::all();

        $users_count = count($data[$class_name]);

        if(!$users_count){
            // Usually sendFail would apply here, but there is no data to return
            return $this->sendError("No {$class_name}(s) were found.", 404);
        }
        
        return $this->sendResponse($data, "Found {$users_count} {$class_name}(s).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class_name = $this->getModelName();
        $data[$class_name] = $this->getModel()::find($id);

        if(!$data[$class_name]){
            return $this->sendFail($id, "Couldn't find '{$class_name}' with the id: {$id}.", 404);
        }

        return $this->sendResponse($data);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getPostValidationRules());

        $model = $this->getModel();
        $class_name = $this->getModelName();

        $data[$class_name] = $model::create($validated);

        if(!$data[$class_name]){
            return $this->sendError("Error creating new '{$class_name}'. Please, try again later.");
        }

        return $this->sendResponse($data, "'{$class_name}' created sucessfully.", 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_request = $request->validate($this->getPutValidationRules());

        $model = $this->getModel();
        $class_name = $this->getModelName();

        $data[$class_name]  = $model::find($id);

        if(!$data[$class_name] ){
            return $this->sendFail($id, "Couldn't find a '{$class_name}' with the id: {$id}.", 404);
        }

        if($data[$class_name]->update($validated_request) === false){
            return $this->sendError("Error updating the '{$class_name}' with id: {$id}.");
        }

        return $this->sendResponse($data, "{$class_name} '{$id}' updated sucesssfully", 200);
    }

    /**
     * Remove the specified resource from storage. Only softdeletes
     */
    public function destroy(string $id)
    {
        $model = $this->getModel();
        $class_name = $this->getModelName();

        $data["result"] = $model::find($id);

        if(!$data["result"]){
            return $this->sendFail($id, "Couldn't find '{$class_name}' with the id: {$id}.", 404);
        }

        if($data["result"]->delete() == false){
            return $this->sendError("Error deleting the '{$class_name}' with id: {$id}.");
        }

        return $this->sendResponse($data, "{$class_name} '{$id}' deleted sucesssfully", 200);
    }
}