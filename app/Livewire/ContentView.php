<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;

class ContentView extends Component
{


    public $body ,$contentTitle, $hideComponent = 'hidden';
    protected $listeners = ['changeDisplay'];

    public $selectAll = false;
    public $checked = true;
    public $selectedItems = [];



    public function mount($body , $contentTitle)
    {
        $this->body = $body;
        $this->contentTitle = $contentTitle;
      
    }

    public function deleteItem($itemId)
    {
        // Document::find($itemId)->delete();
        Document::whereIn('id', $this->selectedItems)->delete();

        $this->selectedItems = [];
    }


    public function changeDisplay()
    {
        $this->hideComponent  = 'block';
    }
    public function render()
    {
        return view('livewire.content-view');
    }
}
