<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
	public function store(Request $request, Room $room)
	{
	    $user = $request->user();
	    $user->rooms()->save($room);
        return $room;
	}

    public function index(Request $request)
    {
        return Auth::user()->rooms;
    }

    public function destroy(Request $request, Room $room)
    {
        Auth::user()->rooms()->detach($room->id);
        return 'ok';
    }
}