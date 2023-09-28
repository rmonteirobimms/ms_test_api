<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePostRequest;
use App\Http\Requests\ProfilePutRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\GenericCrudTrait;

class ProfileController extends Controller
{
    use ApiResponseTrait, GenericCrudTrait;

    function getModel()
    {
        return Profile::class;
    }

    function getModelName()
    {
        return strtolower(trim(class_basename(Profile::class)));
    }

    function getPostValidationRules()
    {
        return (new ProfilePostRequest())->rules();
    }

    function getPutValidationRules()
    {
        return (new ProfilePutRequest())->rules();
    }
}
