<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photos' => 'required|string',
            'room_number' => 'required|string|unique:roomTable,room_number',
            'floor' => 'required|string',
            'type_of_room' => 'required|string',
            'number_of_bed' => 'required|string',
            'details' => 'required|string',
            'max_person' => 'required|string',
            'price' => 'required|numeric',
            'is_available' => 'required|integer',
        ]);

        $room = Room::create($request->all());

        return response()->json($room, 201);
    }

    public function show(Room $room)
    {
        return $room;
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'photos' => 'string',
            'room_number' => 'string|unique:roomTable,room_number,'.$room->room_id.',room_id',
            'floor' => 'string',
            'type_of_room' => 'string',
            'number_of_bed' => 'string',
            'details' => 'string',
            'max_person' => 'string',
            'price' => 'numeric',
            'is_available' => 'integer',
        ]);

        $room->update($request->all());

        return response()->json($room, 200);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json(null, 204);
    }
}

