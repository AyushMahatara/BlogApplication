<?php

namespace App\Http\Controllers;

use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return new UserCollection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user_role = Role::where(['name' => 'author'])->first();
        if ($user_role) {
            $user->assignRole($user_role);
        }

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json([
            'message' => 'User Updated Successfully'
        ], 200);
    }


    public function destroy(User $user)
    {
        if (auth()->check() && auth()->user()->hasRole('admin'))
            $user->delete();
        else
            return response()->json(['message' => 'You are not Authorize successfully'], 403);

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
