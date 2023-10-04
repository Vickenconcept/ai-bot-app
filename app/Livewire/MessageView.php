<?php

namespace App\Livewire;

use App\Models\Bot;
use App\Models\Content;
use App\Models\Conversation;
use App\Models\Document;
use App\Services\ChatGptService;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class MessageView extends Component
{

    public $message;
    public $text = '';
    public $body, $conversationTitle, $conversationonId, $sender, $selectBot, $chatGptService;
    public $isDisabled = true;
    public $allDocumentContents = [];

    public $bot;


    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
        // $this->bot =  Bot::orderBy('id', 'desc')->get();
        $this->bot =  Bot::latest()->get();
    }

    public function pickBot()
    {
        $this->selectBot;

        // $user = auth()->user();

        $conversationToUpdate = Conversation::find($this->conversationTitle->id);
        // $conversationToUpdate = $user->conversations()->find($this->conversationTitle->id);

        $conversationToUpdate->bot_id = $this->selectBot;
        $conversationToUpdate->update();
    }


    public function saveMessage()
    {
        $this->conversationonId;
        $this->message;
        $this->sender = 'user';


        $conversation = Conversation::find($this->conversationTitle->id);
        // $conversation = auth()->user()->conversations()->find($this->conversationTitle->id);

        if (!$conversation) {
            return back()->with('error', 'No conversation found for the user.');
        }

        // dd($this->message);
        $message = $conversation->messages()->create([
            'message' =>   $this->message,
            'sender' => $this->sender,
        ]);
    }

    public function generateContent(ChatGptService $chatGptService)
    {
        // dd($this->conversationTitle->bot->personality);
        $conversation = Conversation::find($this->conversationTitle->id);
        $this->sender = 'user';

        $message = $conversation->messages()->create([
            'message' =>   $this->message,
            'sender' => $this->sender,
        ]);


        // $this->chatGptService = app(ChatGptService::class);
        $userInput = 'Give relvant resposnse to this:' . $this->message . ', check if a related response is in the document , then you can also pick some response there, but if there is no related response to ' . $this->message . ' just go ahead and give a nice response but not refrencing the document at all';


        $botId = $this->conversationTitle->bot->id;


        $contents = Content::with('documents')->get();
        $allDocumentContents = [];

        foreach ($contents as $content) {
            $documentContents = $content->documents->pluck('content')->toArray();
            $allDocumentContents[$content->id] = $documentContents;
        }

        $mergedContent = '';
        $name = $this->conversationTitle->bot->name;

        foreach ($allDocumentContents as $contentArray) {
            $mergedContent .= implode("\n", $contentArray);
        }
        $preprocessedDocument = preprocessContent($mergedContent);
        $combinedPrompt = "Document Context:\n" . $preprocessedDocument . "\nUser Prompt:\n" . $userInput;
        $res = $chatGptService->generateContent($name,$combinedPrompt);
        // dd($this->conversationTitle->bot->name);


        $this->sender = 'bot';


        $conversation->messages()->create([
            'message' =>   $res,
            'sender' => $this->sender,
        ]);
        $this->dispatch('refreshComponent', data: 'hello i am the payload');
        return;
    }
        
        // dd($documents);
        // $documents = Document::pluck('content')->toArray();


        // $htmlContentString = implode("\n", $documents);
        // $preprocessedDocument = preprocessContent($htmlContentString);
        // $combinedPrompt = "Document Context:\n" . $preprocessedDocument . "\nUser Prompt:\n" . $userInput;
        // $res = $this->chatGptService->generateContent($combinedPrompt);



    public function render()
    {

        return view('livewire.message-view');
    }
}
