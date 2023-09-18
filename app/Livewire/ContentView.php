<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;

class ContentView extends Component
{


    public $body ,$contentTitle, $hideComponent = 'hidden';
    protected $listeners = ['refreshComponent'];

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
        Document::find($itemId)->delete();
    }
    public function confirm()
    {
        // $this->selectedItems = $this->checked;

        dd($this->selectedItems);
        Document::whereIn('id', $this->selectedItems)->delete();

        $this->selectedItems = [];
    }

    
    public function updatedSelectAll($value)
    {
        dd($value);
        if ($value) {
            $this->selectedItems = Document::pluck('id')->map(function($id) {
                return (string) $id;
            });
        } else {
            $this->selectedItems = [];
        }
    }

    // public function updatedSelectedItems()
    // {
    //     dd('hello');
    //     $this->selectAll = false;
    // }

    public function refreshComponent()
    {
        $this->hideComponent  = 'block';
    }
    public function render()
    {
        return view('livewire.content-view');
    }
}
