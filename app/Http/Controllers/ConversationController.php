<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = $request->input('query');

        $conversation = Conversation::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->where('type','user')->with('messages')->latest()->get();

        $guest = Conversation::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->where('type','guest')->with('messages')->latest()->get();
        // dd($guest);

        return view('conversations.conversations', compact('conversation','guest'));
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
        $title = 'conversation #' . rand(0, 99999);
        $defaultBot = Bot::where('name', 'bot')->first();
        // // dd($defaultBot->id);


        // dd(Str::uuid()->toString());
        auth()->user()->conversations()->create([
            'uuid' => Str::uuid()->toString(),
            'title' => $title,
            'type' => 'user',
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
        // $body = Conversation::findOrfail($conversation->id)->messages;
        // $conversationTitle = Conversation::findOrfail($conversation->id);
        $conversation =  Conversation::where('type','user')->latest()->get();
        $guest = Conversation::where('type','guest')->with('messages')->latest()->get();



        return view('conversations.show', compact('body', 'conversationTitle', 'conversation','guest'));
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

        $conversationToUpdate = $user->conversations()->find($conversationId);
        

        if (!$conversationToUpdate) {
            return redirect()->back()->with('error', 'Conversation not found.');
        }

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
