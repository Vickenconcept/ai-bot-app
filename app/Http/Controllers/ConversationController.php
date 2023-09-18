<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

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
        })->with('messages')->latest()->get();

        return view('conversations.conversations', compact('conversation'));
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

        // dd('hello');
        auth()->user()->conversations()->create(['title' => $title]);

        return back()->with('success', 'Conversation created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        $body = Conversation::findOrfail($conversation->id)->messages;
        $conversationTitle = Conversation::findOrfail($conversation->id);
        $conversation =  Conversation::latest()->get();

        return view('conversations.show', compact('body', 'conversationTitle', 'conversation'));
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
     */ public function update(Request $request, $conversation)
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
