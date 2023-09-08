<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getModelByName(string $model_name){
        $class_name = "App\Models\\" . ucwords(strtolower(trim($model_name)));
        
        return (!class_exists($class_name)) ? false :  app($class_name);
    }
}
