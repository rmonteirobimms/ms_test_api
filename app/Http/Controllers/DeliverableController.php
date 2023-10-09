<?php

namespace App\Http\Controllers;

use App\Models\Deliverable;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\GenericCrudTrait;
use App\Http\Requests\DeliverablePutRequest;
use App\Http\Requests\DeliverablePostRequest;

class DeliverableController extends Controller
{
    use ApiResponseTrait, GenericCrudTrait;

    function getModel()
    {
        return Deliverable::class;
    }

    function getModelName()
    {
        return strtolower(trim(class_basename(Deliverable::class)));
    }

    function getPostValidationRules()
    {
        return (new DeliverablePostRequest())->rules();
    }

    function getPutValidationRules()
    {
        return (new DeliverablePutRequest())->rules();
    }
}
