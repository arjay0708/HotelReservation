<?php

namespace App\Http\Controllers;

use App\Models\ReasonBackOut;
use Illuminate\Http\Request;

class ReasonBackOutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|integer',
            'user_id' => 'required|integer',
            'reason' => 'required|string',
            'set_by_admin' => 'required|integer',
        ]);

        $reason = ReasonBackOut::create($request->all());

        return response()->json($reason, 201);
    }

    public function show(ReasonBackOut $reason)
    {
        return $reason;
    }

    public function update(Request $request, ReasonBackOut $reason)
    {
        $request->validate([
            'reservation_id' => 'integer',
            'user_id' => 'integer',
            'reason' => 'string',
            'set_by_admin' => 'integer',
        ]);

        $reason->update($request->all());

        return response()->json($reason, 200);
    }

    public function destroy(ReasonBackOut $reason)
    {
        $reason->delete();

        return response()->json(null, 204);
    }
}

