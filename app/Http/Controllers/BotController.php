<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bots =  Bot::latest()->get();
        return view('bots.bot', compact('bots'));
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
        $user = auth()->user();

        $uuid = Str::uuid()->toString();
        $title = 'Bot #' . rand(0, 99999);
        $defaultBot = Bot::where('name', 'bot')->first();


        auth()->user()->conversations()->create([
            'uuid' => $uuid,
            'title' => $title,
            'type' => 'guest',
            'bot_id' => $defaultBot->id
        ]);


        $validated = $request->validate([
            'name' => 'required',
            'personality' => 'required',
            'description' => 'sometimes',
            'model' => 'required',
            'uuid_chat' => 'sometimes',
        ]);
        $validated['uuid_chat'] = $uuid;
        // dd($validated['uuid_chat'] );

        $message = $user->bots()->create($validated);




        // $request->session()->put('bot_default_conversation', $uuid);
        // dd($uuid);

        return back()->with('success', 'bot created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bot $bot, Request $request)
    {

        // $uuid = $request->session()->get('bot_default_conversation');
        $singleBot = Bot::findOrfail($bot->id);
        $uuid = $singleBot->uuid_chat;
        $conversation = Conversation::where('uuid', $uuid)->first();
        
        if (!$conversation) {
            // dd('heloo');
            $title = 'Bot #' . rand(0, 99999);
            $defaultBot = Bot::where('name', 'bot')->first();


            auth()->user()->conversations()->create([
                'uuid' => $uuid,
                'title' => $title,
                'type' => 'guest',
                'bot_id' => $defaultBot->id
            ]);
        }

        $guestChat = Conversation::where('uuid', $uuid)->firstOrFail();

        return view('bots.show', compact('singleBot', 'guestChat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bot $bot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $bot)
    {
        $botId = $request->input('botId');
        $user = auth()->user();
        $requiredBot = $user->bots()->find($botId);

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'sometimes',
            'model' => 'required',
        ]);

        $requiredBot->update($validated);

        return back()->with('success', 'bot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bot)
    {
        $user = auth()->user();

        $con = Conversation::all();
        $updateBots = $con->where('bot_id', $bot);

        foreach ($updateBots as $updateBot) {
            $updateBot->bot_id = 1;

            $updateBot->update();
        }


        $bot = Bot::find($bot);
        $bot->delete();

        return redirect()->back()->with('success', 'Bot deleted successfully.');
    }
}
