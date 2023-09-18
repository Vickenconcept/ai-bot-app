<?php

namespace App\Livewire;

use Livewire\Component;

class ContentView extends Component
{


    public $body ,$contentTitle, $test = 'hidden';
    protected $listeners = ['refreshComponent'];
    public $isLoading = false;



    public function mount($body , $contentTitle)
    {
        $this->body = $body;
        $this->contentTitle = $contentTitle;
      
    }

    public function refreshComponent()
    {
        // dd('jjjj');
        
        $this->isLoading = true;
        $this->test  = 'block';
    }
    public function render()
    {
        return view('livewire.content-view');
    }
}
