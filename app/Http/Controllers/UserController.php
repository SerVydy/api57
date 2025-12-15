<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', //|regex:/^[A-Z][a-z]+\s[A-Z][a-z]+\s[A-Z][a-z]+$/
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'phone' => 'nullable|regex:/^\+7\([0-9]{3}\)[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', //+7(999)999-99-99
            'avatar' => 'nullable|image|max:1024'
        ]);

        if($validator->fails()) {
            return response()->json([
                $validator->errors(),
                'phone' => 'Нужен телефон в таком только формате +7(999)999-99-99'
            ], 400);
        }

        $validated = $validator->validated();

        $avatar = $request->avatar->store('avatars','public');

        $user = User::create(['avatar' => $avatar] + $validated);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(isset($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();
        return response()->json([],204);
    }
}
