<?php

namespace App\Http\Controllers;

use App\Models\ReasonDecline;
use Illuminate\Http\Request;

class ReasonDeclineController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|integer',
            'user_id' => 'required|integer',
            'reason' => 'required|string',
        ]);

        $reason = ReasonDecline::create($request->all());

        return response()->json($reason, 201);
    }

    public function show(ReasonDecline $reason)
    {
        return $reason;
    }

    public function update(Request $request, ReasonDecline $reason)
    {
        $request->validate([
            'reservation_id' => 'integer',
            'user_id' => 'integer',
            'reason' => 'string',
        ]);

        $reason->update($request->all());

        return response()->json($reason, 200);
    }

    public function destroy(ReasonDecline $reason)
    {
        $reason->delete();

        return response()->json(null, 204);
    }
}

