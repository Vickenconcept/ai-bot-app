<?php

namespace App\Livewire;

use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class MessageView extends Component
{

    public $message;
    public $text = '' ;
    public $body ,$conversationTitle, $conversationonId,$sender;
    public $isDisabled = true;


    public function mount($body , $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
      
    }
    public function updateChatBox()
    {
        $this->body = $this->body;
        
      
    }


    public function saveMessage()
    {
        $this->conversationonId;
        $this->message;
        $this->sender = 'user';
        
      
        $conversation = auth()->user()->conversations()->find($this->conversationTitle->id);
        
        if (!$conversation) {
            return back()->with('error', 'No conversation found for the user.');
        }

        // dd($this->message);
        $message = $conversation->messages()->create([
            'message' =>   $this->message,
            'sender' => $this->sender,
        ]);
    }
    public function render()
    {
         
        return view('livewire.message-view');
    }
}
