<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $conversation = auth()->user()->conversations()->find($id);
        
        if (!$conversation) {
            return back()->with('error', 'No conversation found for the user.');
        }

        // dd($this->message);
        $message = $conversation->messages()->create([
            'message' =>   $this->message,
            'sender' => $this->sender,
        ]);
        $this->message = '';

        return back()->with('success', 'Message sent successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show( $conversation)
    {
        $body = Conversation::findOrFail($conversation)->messages;
        $conversationTitle = Conversation::findOrFail($conversation);
        // dd($conversationTitle);
        $conversation = Conversation::latest()->get();
    
        return new JsonResponse([
            'body' => $body,
            'conversationTitle' => $conversationTitle,
            'conversation' => $conversation
        ]);
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
