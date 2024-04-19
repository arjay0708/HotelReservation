<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photos' => 'required|string',
            'email' => 'required|email|unique:usertable,email',
            'password' => 'required|string',
            'is_active' => 'required|integer',
            'is_admin' => 'required|integer',
        ]);

        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'photos' => 'string',
            'email' => 'email|unique:usertable,email,'.$user->user_id.',user_id',
            'password' => 'string',
            'is_active' => 'integer',
            'is_admin' => 'integer',
        ]);

        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}

