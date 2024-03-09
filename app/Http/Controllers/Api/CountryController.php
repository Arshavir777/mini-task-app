<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Country;

class CountryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::get();
        return $this->successResponse($countries);
    }
}
