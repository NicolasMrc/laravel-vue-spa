<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
	public function show(Request $request)
	{
        $roomId = $request->get('room_id');
        return Room::where('id', $roomId);
	}

    public function index(Request $request)
    {
        return Room::all();
    }

    public function store(Request $request)
    {
        $room = new Room();
        $room->name = $request->get('name');
        $room->save();

        return $room;
    }

}