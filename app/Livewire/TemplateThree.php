<?php

namespace App\Livewire;

use Livewire\Component;

class TemplateThree extends Component
{

    public
        $body,
        $conversationTitle,
        $currentResponseIndex = 0,
        $chat,
        $email,
        $phoneNumber,
        $userResponse = '',
        $history = [],
        $chatData = [];

        protected $listeners = ['nextResponse'];



    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
        $this->history[0] = $this->conversationTitle->temp_three[0];
        $this->chatData = $this->conversationTitle->temp_three;

        foreach ($this->chatData as $chat) {
            $this->chat = $chat;
        }


        // $this->bot =  Bot::latest()->get();
        // $this->contents =  Content::latest()->get();
    }

    public function nextResponse()
    {
        // dd($this->conversationTitle->temp_three);
        if  ($this->currentResponseIndex <  count($this->chatData) - 1  ) {
            # code...
            $this->currentResponseIndex++;
            
            $this->history[] = $this->chatData[$this->currentResponseIndex];
        }else{

            return;
        }
    }

    public function addResponse()
    {
        // Move to the next response
        $this->chatData[] = '';

        // You can add logic to handle reaching the end of the responses array
    }
    public function render()
    {
        return view('livewire.template-three');
    }
}
