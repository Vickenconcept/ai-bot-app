<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;

class SelectLanguage extends Component
{


    public $guestChat, $conversation, $lang;
    protected $listeners = ['selectedTemplate'];

    public function mount($guestChat)
    {
        $this->guestChat = $guestChat;
        $uuid = $this->guestChat->uuid;
        $this->conversation = Conversation::where('uuid', $uuid)->first();
        $this->lang = $this->conversation->lang;
    }

    public function selectLanguage(){

        // dd($this->conversation->lang);
        $this->conversation->lang = $this->lang;
        $this->conversation->update();

    }

    public function render()
    {
        // dd($this->conversation);
        return view('livewire.select-language');
    }
}
