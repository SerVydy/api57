<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();

        return CountryResource::collection($countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:countries'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };

        $validated = $validator->validated();

        $country = Country::create($validated);

        return new CountryResource($country);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return new CountryResource($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:countries'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };

        $validated = $validator->validated();

        $country->update($validated);

        return new CountryResource($country);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json([
            'message' => "$country delete"
        ], 204);
    }
}
