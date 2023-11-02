<?php

namespace App\Livewire;

use Livewire\Component;

class TemplateOne extends Component
{

    public 
    $body, 
    $conversationTitle;
    
    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
        // $this->bot =  Bot::latest()->get();
        // $this->contents =  Content::latest()->get();
    }

    public function render()
    {
        return view('livewire.template-one');
    }
}
