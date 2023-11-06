<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;

class SelectTemplate extends Component
{
    public $templates = [
        ['template 1', 'https://images.unsplash.com/photo-1699100329878-7f28bb780787?auto=format&fit=crop&q=60&w=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxMHx8fGVufDB8fHx8fA%3D%3D'],
        ['template 2', 'https://media.istockphoto.com/id/1474993860/photo/mockup-for-social-media-post-with-photo-carousel.webp?b=1&s=170667a&w=0&k=20&c=XrIUwn0Mr8eNnY52jcwH43bIXYg7zkEPdKr8mzLmI3I='],
        ['template 3', 'https://plus.unsplash.com/premium_photo-1681487807762-98fbe8a9db5e?auto=format&fit=crop&q=60&w=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGNoYXR8ZW58MHx8MHx8fDA%3D'],
        ['template 4', 'https://media.istockphoto.com/id/1413855189/photo/chat-bot-service-concept-virtual-assistant-and-crm-software-automation-technology-customer.jpg?s=612x612&w=0&k=20&c=5wY13TF0YQWF_Ktt0HU9CcjRE6h0wvBpxG78XSLU0-U='],
        ['template 5', 'https://media.istockphoto.com/id/1356965747/photo/businesswoman-watching-a-live-business-stream-online-live-stream-window-video-streaming-on.jpg?s=612x612&w=0&k=20&c=PABQURWQhJAhR84qoU1RwoaMfh2eQp2LOgtfjV-mhwM='],
        ['template 6', 'https://media.istockphoto.com/id/1461083586/photo/half-folded-flyer-a4-booklet-mock-up-on-white-background.webp?b=1&s=170667a&w=0&k=20&c=fjw90yGrGs0XV_RcWtgRfbZ3mDOrZqnw_yzmXuSrRyQ='],
    ];
    // public $templates = ['template 1', 'template 2', 'template 3', 'template 4', 'template 5', 'template 6'];
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

    public function addToTemplateThree()
    {
        $this->tempThreeDefaultData[] = '';
    }
    public function addToTemplateFour()
    {
        $this->tempFourDefaultData[] = '';
    }
    public function addToTemplateFive()
    {
        $this->tempFiveDefaultData[] = '';
    }


    public function render()
    {
        return view('livewire.select-template');
    }
}
