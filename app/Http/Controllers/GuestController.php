<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function __construct()
    {

        $this->middleware('checkRouteStatus')->only('show');
    }
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
            'uuid' => Str::uuid()->toString(),
            'title' => $title,
            'type' => 'guest',
            'bot_id' => $defaultBot->id
        ]);

        return back()->with('success', 'Conversation created successfully');
    }


    /**
     * Display the specified resource.
     */

    public function show($uuid)
    {
        $body = Conversation::where('uuid', $uuid)->first();
        $bot = Bot::where('uuid_chat', $uuid)->first();
        // dd($bot->uuid_chat);

        if (!$body) {
            if ($bot != null && $bot->uuid_chat === $uuid ) {
                # code...
                // dd($bot->uuid_chat);
             
                $title = 'bot #' . rand(0, 99999);
                $defaultBot = Bot::where('name', 'bot')->first();

                Conversation::create([
                    'user_id' => $bot->user->id,
                    'uuid' => $bot->uuid_chat,
                    'title' => $title,
                    'type' => 'guest',
                    'bot_id' => $defaultBot->id
                ]);
                $body = Conversation::where('uuid', $uuid)->firstOrFail()->messages;
                $conversationTitle = Conversation::where('uuid', $uuid)->firstOrFail();
            }
            ;
           return view('error.404');
        //    return response()->json('widget canceled');
        } else {
            
            $body = Conversation::where('uuid', $uuid)->firstOrFail()->messages;
            $conversationTitle = Conversation::where('uuid', $uuid)->firstOrFail();
            $conversation = Conversation::where('type', 'guest')->latest()->get();
            $guest = Conversation::where('type', 'guest')->with('messages')->latest()->get();
        }

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
     */ public function update(Request $request, $conversation)
    {
        $status = $request->input('statues');
        
        
        // Find the specific conversation by ID
        $conversation = Conversation::find($conversation);
        // dd($conversation);
        

        // Update the title of the conversation
        $conversation->enabled = $status;
        $conversation->update();

        return redirect()->back()->with('success', 'Status updated successfully.');
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
