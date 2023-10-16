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

        if (!$conversation) {
            return back()->with('error', 'No conversation found for the user.');
        }

        $message = $conversation->messages()->create([
            'message' =>   $this->message,
            'sender' => $this->sender,
        ]);
    }

    public function generateContent(ChatGptService $chatGptService)
    {
        $conversation = Conversation::find($this->conversationTitle->id);
        $this->sender = 'user';
        $personality = $this->conversationTitle->bot->personality;

       
        $message = $conversation->messages()->create([
            'message' =>   $this->message,
            'sender' => $this->sender,
        ]);

        $userInput = '';
        if ($personality === '' || $personality === null) {
            # code...
            $userInput = 'Give relvant resposnse to this:' . $this->message . ', Please always ignore the document data while giving response, except if ( ' . $this->message . ' ) is related to any data in the document then you pick  from the document and paraphrase what you picked.  just go ahead and give a nice response but not refrencing the document at all, And remember if there is a respone pattern or structure in the document try to always use it. ';
        }else {
            $userInput = "Give relvant resposnse to this:' . $this->message . ' from the document, always pay attention to the document, And remember if there is a respone pattern or structure in the document try to always use it.Don't give resonse that will expose that you are picking data from the document, just go professional, If the answer cannot be found in the articles, write 'I could not find an answer'. ";
        }


        $botId = $this->conversationTitle->bot->id;
        $knowledge = $this->conversationTitle->bot->knowledge;
        $knowledgeIdsJson = $this->conversationTitle->bot->knowledge;

        $knowledgeIds = json_decode($knowledgeIdsJson, true);
        if ( $knowledgeIds != null) {
            $knowledgeIds = array_map('intval', $knowledgeIds);
            $contents = Content::whereIn('id', $knowledgeIds)->get();
        }else {
            $contents = Content::with('documents')->get();
        }
        


        $allDocumentContents = [];

        foreach ($contents as $content) {
            $documentContents = $content->documents->pluck('content')->toArray();
            $allDocumentContents[$content->id] = $documentContents;
        }

        $mergedContent = '';
        $name = $this->conversationTitle->bot->name;
        $model = $this->conversationTitle->bot->model;
        $system = 'You are a knowledgeable assistant that provides detailed explanations about topics';

        if ($personality === 'factual') {
            
            $system = "In providing factual information, I'll offer accurate and reliable details on various topics, helping you make informed decisions and broaden your knowledge. Let's explore the world of facts and information.
           ";
        }
        if ($personality === 'hr') {
            
            $system = "In the realm of HR, I'm here to assist you with policies, procedures, employee onboarding, and any HR-related inquiries you may have. Let's streamline HR processes and enhance employee experiences.
           ";
        }
        if ($personality === 'creative') {
            
            $system = "For a creative approach, I'll help you brainstorm ideas, craft engaging narratives, develop artistic concepts, and think outside the box. Let's unleash creativity and bring your innovative visions to life.
           ";
        }
        if ($personality === 'itSupport') {
            
            $system = "For IT support, I'll assist you in troubleshooting technical issues, setting up systems, explaining code, and providing solutions to enhance your IT operations. Let's ensure a seamless tech environment.
           ";
        }
        if ($personality === 'tranning') {
            
            $system = "In providing factual information, I'll offer accurate and reliable details on various topics, helping you make informed decisions and broaden your knowledge. Let's explore the world of facts and information.
           ";
        }
        if ($personality === 'custormerSupport') {
            
            $system = "As a customer support assistant, I'm here to address your customer queries, offer product assistance, and provide helpful insights to improve customer satisfaction. Let's enhance the customer experience together.
           ";
        }
        

        // $sum = 'Please summarize this( ' . $mergedContent . ') and get the main point, not more than 3500 words remove filler words and put it in filler words , for a bot to get data from it';
        // $res = $chatGptService->generateContent($name,$model,$system, $sum);
        foreach ($allDocumentContents as $contentArray) {
            $mergedContent .= implode("\n", $contentArray);
        }

        $preprocessedDocument = preprocessContent($mergedContent);
        $contentArray = $contentArray ?? 'DO GIVE GOOD RESPONSE';
        $json =  json_encode($contentArray) ;
        $characterCount = strlen($json);
        // dd($characterCount);

        $document = "Document Context:\n" . $json ;
        $combinedPrompt =  "\nUser Prompt:\n" . $userInput;
        // $combinedPrompt = "Document Context:\n" . $json . "\nUser Prompt:\n" . $userInput;
        // $combinedPrompt = "Document Context:\n" . $mergedContent . "\nUser Prompt:\n" . $userInput;
        $res = $chatGptService->generateContent($name,$model,$system, $combinedPrompt, $document);
        // dd($res);
        if ($res === 'Connection error. Please try again later.') {
          return;
        }

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
