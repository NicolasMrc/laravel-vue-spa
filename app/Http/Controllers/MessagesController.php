<?php

namespace App\Http\Controllers;

use App\Message;
use App\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{

    public function index(Request $request, Room $room)
    {
        //TODO check is auth->user subscribed to room

        $user = Auth::user();
        $date = $room->users->find($user->id)->pivot->created_at;
        $after = $room->messages()->where('created_at', '>=', $date)->get();
        $before = $room->messages()->where('created_at', '<=', $date)->latest()->limit(10)->get();
        $all = $before->merge($after);
        return new JsonResponse($all);
    }

    public function store(Request $request, Room $room)
    {
        $message = new Message();
        $message->text = $request->get('message');
        $message->room()->associate($room);
        $message->user()->associate(Auth::user());
        $message->save();

        return new JsonResponse($message);
    }

}