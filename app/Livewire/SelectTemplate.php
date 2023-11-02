<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;

class SelectTemplate extends Component
{
    public $templates = ['template 1', 'template 2', 'template 3', 'template 4', 'template 5', 'template 6'];
    public $imageUrl = [],
        $productPrice = [],
        $productName = [],
        $tempThree = [],
        $tempThreeDefaultData = [
            'Hello, how can I assist you?',
            'Welcome to our website.',
            'We are not Available right now.',
            'We Can get in tourch to provide the request.',
            'Please let us know how you prefer to be contacted (email or phone).',
            'Thanks we will get in touch soon.',

        ];
    public $guestChat, $conversation;
    protected $listeners = ['selectedTemplate'];

    public function mount($guestChat)
    {
        $this->guestChat = $guestChat;
        $uuid = $this->guestChat->uuid;
        $this->conversation = Conversation::where('uuid', $uuid)->first();
    }

    public function selectedTemplate($id)
    {



        switch ($id) {
            case 'template 1':
                $this->conversation->template = 'temp1';
                break;
            case 'template 2':
                $this->conversation->template = 'temp2';
                break;
            case 'template 3':
                $this->conversation->template = 'temp3';
                break;
            case 'template 4':
                $this->conversation->template = 'temp4';
                break;
            case 'template 5':
                $this->conversation->template = 'temp5';
                break;
            case 'template 6':
                $this->conversation->template = 'temp6';
                break;
        }

        $this->conversation->update();
    }

    public function customizeTemplateTwo()
    {
        $this->conversation;

        $result = array_map(function ($url, $price, $name) {
            return ['url' => $url, 'price' => $price, 'name' => $name];
        }, $this->imageUrl, $this->productPrice, $this->productName);
        // dd($this->productPrice);

        $this->conversation->image_link = $result ?? null; // Example image links

        $this->conversation->update();
    }
    public function customizeTemplateThree()
    {
        // dd($this->tempThree);

        $this->conversation->temp_three = $this->tempThree; // Example image links

        $this->conversation->update();
    }


    public function render()
    {
        return view('livewire.select-template');
    }
}
