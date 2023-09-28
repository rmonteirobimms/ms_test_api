<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskPostRequest;
use App\Http\Requests\TaskPutRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\GenericCrudTrait;

class TaskController extends Controller
{
    use ApiResponseTrait, GenericCrudTrait;

    function getModel()
    {
        return Task::class;
    }

    function getModelName()
    {
        return strtolower(trim(class_basename(Task::class)));
    }

    function getPostValidationRules()
    {
        return (new TaskPostRequest())->rules();
    }

    function getPutValidationRules()
    {
        return (new TaskPutRequest())->rules();
    }
}
