<?php

namespace App\Livewire;

use App\Services\MailChimpService;
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
        $secondToLastIndex,
        $userResponse = '',
        $history = [],
        $chatData = [];

    protected $listeners = ['nextResponse'];



    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
        $this->history[0] = $this->conversationTitle->temp_three[0] ?? [];
        $this->chatData = $this->conversationTitle->temp_three ?? [];
        $this->secondToLastIndex = count($this->chatData) - 1 ?? '';

        foreach ($this->chatData as $chat) {
            $this->chat = $chat;
        }

        
    }

    public function nextResponse()
    {
        if ($this->currentResponseIndex <  count($this->chatData) - 1) {
            # code...
            $this->currentResponseIndex++;

            $this->history[] = $this->chatData[$this->currentResponseIndex];
        } else {

            return;
        }
    }

    public function subscribe(MailChimpService $mailChimpService)
    {
        $contacts = $this->conversationTitle->users_contact_info ?? [];
        array_push($contacts, $this->email ?? $this->phoneNumber);
        $res = $this->conversationTitle->users_contact_info = $contacts;
        $this->conversationTitle->update();
    }


    public function render()
    {
        if ($this->chatData  !== [] &&  count($this->chatData) !== 1) {
            return view('livewire.template-three');
        } else {
            return view('errors.404');
        }
    }
}
