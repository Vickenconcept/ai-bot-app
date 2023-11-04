<?php

namespace App\Livewire;

use App\Services\MailChimpService;
use Livewire\Component;

class TemplateFive extends Component
{
    public $body,
        $conversationTitle,
        $currentResponseIndex,
        $email,
        $secondToLastIndex,
        $secondToLastValue,
        $history = [],
        $chatData = [
            // 'Hello, how can I assist you?',
            // 'Welcome to our website.',
            // 'We are not Available right now.',
            // 'https://images.unsplash.com/photo-1698402532181-78b834538a86?auto=format&fit=crop&q=60&w=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0fHx8ZW58MHx8fHx8',
            // 'We Can get in tourch to provide the request.',
            // 'https://images.unsplash.com/photo-1698402926566-240a7adb1523?auto=format&fit=crop&q=60&w=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxMHx8fGVufDB8fHx8fA%3D%3D',
            // 'Please let us know how you prefer to be contacted (email or phone).',
            // 'Thanks we will get in touch soon.',
        ];
    protected $listeners = ['nextResponse'];


    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
        // $this->secondToLastValue = array_slice($this->chatData, -2, 1)[0] ?? [];
        $this->history[0] = $this->conversationTitle->temp_five[0] ?? [];
        $this->chatData = $this->conversationTitle->temp_five ?? [];
        $this->secondToLastIndex = count($this->chatData) - 1 ?? '';
    }

    public function subscribe(MailChimpService $mailChimpService)
    {
        $contacts = $this->conversationTitle->users_contact_info ?? [];
        array_push($contacts, $this->email);
        $res = $this->conversationTitle->users_contact_info = $contacts;
        $this->conversationTitle->update();
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


    public function render()
    {

        if ($this->chatData  !== [] &&  count($this->chatData) !== 1) {
            return view('livewire.template-five');
        } else {
            return view('errors.404');
        }
    }
}
