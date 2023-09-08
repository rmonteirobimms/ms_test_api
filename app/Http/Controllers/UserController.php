<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserPutRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\UserPostRequest;
use App\Http\Traits\GenericCrudTrait;

class UserController extends Controller
{
    use ApiResponseTrait, GenericCrudTrait;

    function getModel()
    {
        return User::class;
    }

    function getModelName()
    {
        return strtolower(trim(class_basename(User::class)));
    }

    function getPostValidationRules()
    {
        return (new UserPostRequest())->rules();
    }

    function getPutValidationRules()
    {
        return (new UserPutRequest())->rules();
    }
}
