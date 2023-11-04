<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;

class SelectTemplate extends Component
{
    public $templates = ['template 1', 'template 2', 'template 3', 'template 4', 'template 5', 'template 6'];
    public $imageUrl = [],
        $inputs = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        $productPrice = [],
        $productName = [],
        $tempThree = [],
        $tempFour = [],
        $tempFive = [],
        $tempThreeDefaultData = [
            'Hello, how can I assist you?',
            'Welcome to our website.',
            'We are not Available right now.',
            'We Can get in tourch to provide the request.',
            'Please let us know how you prefer to be contacted (email or phone).',
            'Thanks we will get in touch soon.',

        ],
        $tempFourDefaultData = [
            'Hello, how can I assist you?',
            'https://yourImageLink.com',
            'https://image.com',
            'We Can get in tourch to provide the request.',
            'Provide us with your email address',
            'Thanks we will get in touch soon.',

        ],
        $tempFiveDefaultData = [
            'Hello, how can I assist you?',
            'https://yourVideoLink.com',
            'https://youtube.video.com',
            'We Can get in tourch to provide the request.',
            'Provide us with your email address',
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
        $this->conversation->temp_three = $this->tempThree; // Example image links

        $this->conversation->update();
    }
    public function customizeTemplateFour()
    {
        $this->conversation->temp_four = $this->tempFour; // Example image links

        $this->conversation->update();
    }
    public function customizeTemplateFive()
    {
        $this->conversation->temp_five = $this->tempFive; // Example image links

        $this->conversation->update();
    }

    public function addToTemplateThree(){
        $this->tempThreeDefaultData[] = '';
    }
    public function addToTemplateFour(){
        $this->tempFourDefaultData[] = '';
    }
    public function addToTemplateFive(){
        $this->tempFiveDefaultData[] = '';
    }


    public function render()
    {
        return view('livewire.select-template');
    }
}
