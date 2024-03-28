<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Content;
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
        $bots =  Bot::latest()->paginate(10);
        // dd($bots);
        $contents = Content::latest()->get();
        return view('bots.bot', compact('bots','contents'));
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

        $validated = $request->validate([
            'name' => 'required',
            'personality' => 'required',
            'description' => 'sometimes',
            'model' => 'required',
            'knowledge' => 'required',
            'uuid_chat' => 'sometimes',
        ]);
        $validated['uuid_chat'] = $uuid;
   
        $validated['knowledge'] = json_encode($validated['knowledge']);

        $message = $user->bots()->create($validated);


        
        $title = 'Bot #' . rand(0, 99999);
        $defaultBot = Bot::where('name', 'bot')->first();


        auth()->user()->conversations()->create([
            'uuid' => $uuid,
            'title' => $title,
            'type' => 'guest',
            'avatar' => [
                'image_url' => asset('video/preview (1).mp4'),
                'gender' => 'male',
            ],
            'bot_id' => $defaultBot->id
        ]);




        // $request->session()->put('bot_default_conversation', $uuid);
        // dd($uuid);

        return back()->with('success', 'bot created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bot $bot, Request $request)
    {

        // $singleBot = Bot::findOrfail($bot->id);
        $singleBot = $bot;
        $uuid = $bot->uuid_chat;
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

        if ($conversation) {
            $guestChat = $conversation;
            return view('bots.show', compact('singleBot', 'guestChat'));
        }else {
            return 'something went wrong ,refresh page';
        }

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
    public function update(Request $request)
    {
        $botId = $request->input('botId');
        $user = auth()->user();
        $requiredBot = $user->bots()->find($botId);

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'sometimes',
            'model' => 'required',
            'knowledge' => 'required',
        ]);
        $validated['knowledge'] = json_encode($validated['knowledge']);

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
