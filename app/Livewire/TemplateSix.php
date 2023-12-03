<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\MailChimpService;
use Livewire\Component;

class TemplateSix extends Component
{

    public
        $body,
        $data,
        $conversationTitle,
        $sharedEmail;

    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->data = json_decode($conversationTitle->temp_six);
        $this->conversationTitle = $conversationTitle;
        $user = User::find($conversationTitle->user_id);
        $this->sharedEmail = $user->email;

        // $this->bot =  Bot::latest()->get();
        // $this->contents =  Content::latest()->get();
    }

    public function saveImage()
    {
    }

    public function render()
    {
        return view('livewire.template-six');
    }
}
