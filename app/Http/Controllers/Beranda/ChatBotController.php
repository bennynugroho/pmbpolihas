<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use App\Models\ChatBot;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function getAnswer($id)
    {
        $chat = ChatBot::find($id);

        return response()->json($chat);
    }
}
