<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ParticipantChat;

class ParticipantChatController extends Controller
{
    public function store(Request $request, $plan_id){
        $request->validate([
            'participant_chat_body'.$plan_id =>'required|max:100',
        ],[
            "participant_chat_body$plan_id.required" => 'A comment is required.',
            "participant_chat_body$plan_id.max" => 'Maximum of 100 characters only.'
        ]);

        $participant_chat = new ParticipantChat();
        $participant_chat->body = $request->input('participant_chat_body'.$plan_id);
        $participant_chat->user_id = Auth::id();
        $participant_chat->plan_id = $plan_id;
        $participant_chat->save();

        return redirect()->back();

    }

    public function destroy($id){
        ParticipantChat::destroy($id);

        return redirect()->back();
    }
}
