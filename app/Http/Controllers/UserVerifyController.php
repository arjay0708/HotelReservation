<?php

namespace App\Http\Controllers;

use App\Models\UserVerify;
use Illuminate\Http\Request;

class UserVerifyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'token' => 'required|string',
        ]);

        $userVerify = UserVerify::create($request->all());

        return response()->json($userVerify, 201);
    }

    public function show(UserVerify $userVerify)
    {
        return $userVerify;
    }

    public function update(Request $request, UserVerify $userVerify)
    {
        $request->validate([
            'user_id' => 'integer',
            'token' => 'string',
        ]);

        $userVerify->update($request->all());

        return response()->json($userVerify, 200);
    }

    public function destroy(UserVerify $userVerify)
    {
        $userVerify->delete();

        return response()->json(null, 204);
    }
}

