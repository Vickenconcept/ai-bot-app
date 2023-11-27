<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TemplateTwo extends Component
{

    public
        $body,
        $conversationTitle,
        $sharedEmail;

    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
        $user = User::find($this->conversationTitle->user_id);
        $this->sharedEmail = $user->email;

        // $this->bot =  Bot::latest()->get();
        // $this->contents =  Content::latest()->get();
    }

    public function saveImage()
    {
    }

    public function render()
    {
        return view('livewire.template-two');
    }
}
