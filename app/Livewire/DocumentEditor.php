<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;

class DocumentEditor extends Component
{

    public $document,$content;
    public function mount($document)
    {
        $this->document = $document;
        $this->content = $this->document->content;
    }
    public function documentSaveChanges()
    {
        $this->validate([
            'content' => 'required|max:3000',
        ]);

        $preprocessedDocument = strip_tags($this->content);

        $this->content;
        $doc = Document::find($this->document->id);
        $doc->content = $preprocessedDocument ?? 'content error';
        $doc->update();
    }
    public function deleteDocument()
    {
        try {
            Document::whereIn('id', explode(',', $this->document->id))->delete();
            redirect()->to('contents');
        } catch (\Exception $e) {
        }
    }


    public function render()
    {
        return view('livewire.document-editor');
    }
}
