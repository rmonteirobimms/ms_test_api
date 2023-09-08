<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkRestoreRequest;
use Illuminate\Http\Request;

class RestoreController extends Controller
{    
    /**
     * Restore the specified users. Only works on softdeletes
     */
    public function restore(string $resource, string $id)
    {
        $model = $this->getModelByName($resource);

        if($model === false){
            return $this->sendFail([$resource, $id], "Couldn't find resource '{$resource}'.", 404);
        }

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

    /**
     * Bulk restores the given users. Only works on softdeletes
     */
    public function bulk_restore(BulkRestoreRequest $request)
    {
        $request_validated = $request->validated();
        $ids = $request_validated["id"];
        $resource = $request_validated["resource"];

        $model = $this->getModelByName($resource);

        if($model === false){
            return $this->sendFail($request_validated, "Couldn't find resource '{$resource}'.", 404);
        }

        $soft_deleted_records = $model::onlyTrashed()->whereIn('id', $ids)->get();

        if(!$soft_deleted_records){
            return $this->sendFail($request_validated, "Couldn't find '{$resource}'(s) with the given ID(s).", 404);
        }

        $data["restored"] = $soft_deleted_records->each->restore();

        if(!$data["restored"]){
            return $this->sendError("Error restoring '{$resource}'(s) with the given ID(s).");
        }

        return $this->sendResponse($data, "{$resource}(s) restored successfully.");
    }
}
