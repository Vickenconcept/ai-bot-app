<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Conversation;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
       return;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = 'guest #' . rand(0, 99999);
        $defaultBot = Bot::where('name', 'bot')->first();
   
        auth()->user()->conversations()->create([
            'title' => $title,
            'type' => 'guest',
            'bot_id' => $defaultBot->id
        ]);

        return back()->with('success', 'Conversation created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $body = Conversation::where('slug', $slug)->firstOrFail()->messages;
        $conversationTitle = Conversation::where('slug', $slug)->firstOrFail();
        // $body = Conversation::findOrfail($id)->messages;
        // $conversationTitle = Conversation::findOrfail($id);
        // dd($conversationTitle->bot);
        $conversation =  Conversation::where('type','guest')->latest()->get();
        $guest = Conversation::where('type','guest')->with('messages')->latest()->get();

        return view('conversations.show-guest', compact('body', 'conversationTitle', 'conversation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */ public function updateConversation(Request $request)
    {
        $title = $request->input('title');
        $conversationId = $request->input('conversationId');
        // dd($conversationId);
        $user = auth()->user();

        // Find the specific conversation by ID
        $conversationToUpdate = $user->conversations()->find($conversationId);

        if (!$conversationToUpdate) {
            return redirect()->back()->with('error', 'Conversation not found.');
        }

        // Update the title of the conversation
        $conversationToUpdate->title = $title;
        $conversationToUpdate->update();

        return redirect()->back()->with('success', 'Conversation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($conversation)
    {
        $user = auth()->user();

        $conversation = Conversation::find($conversation);
        $conversation->delete();

        return redirect()->to('conversations')->with('success', 'Conversation deleted successfully.');
    }
}
