<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = ['Russia','Japan'];

        return response()->json([
            'message' => 'List Country',
            'data' => $countries,
            'erorr' => false,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Country created'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $country)
    {
        return response()->json([
            'message' => '$country'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $country)
    {
        return response()->json([
            'message' => "$country updated"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $country)
    {
        return response()->json([
            'message' => "$country delete"
        ], 204);
    }
}
