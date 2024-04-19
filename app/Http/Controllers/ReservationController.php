<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_code' => 'required|string',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'start_dataTime' => 'required|date_format:Y-m-d H:i:s',
            'end_dateTime' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
            'is_archived' => 'required|string',
            'is_noted' => 'required|integer',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json($reservation, 201);
    }

    public function show(Reservation $reservation)
    {
        return $reservation;
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'book_code' => 'string',
            'user_id' => 'integer',
            'room_id' => 'integer',
            'start_dataTime' => 'date_format:Y-m-d H:i:s',
            'end_dateTime' => 'date_format:Y-m-d H:i:s',
            'status' => 'string',
            'is_archived' => 'string',
            'is_noted' => 'integer',
        ]);

        $reservation->update($request->all());

        return response()->json($reservation, 200);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json(null, 204);
    }
}

