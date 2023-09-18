<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
// use Livewire\WithFileUploads;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\IOFactory;

class UploadDocument extends Component
{


    // use WithFileUploads; // Use the trait

    public $file;

    public $body, $contentTitle, $title, $content,  $updatedContent;


    public function mount($body, $contentTitle)
    {
        $this->body = $body;
        $this->contentTitle = $contentTitle;
    }
    public function saveWrittenDocument()
    {
        $user = auth()->user()->contents()->find($this->contentTitle->id);
        $this->title;
        $this->content;
        $this->contentTitle->id;
        // sleep(10);
        $user->documents()->create([
            'title' =>  $this->title,
            'content' =>  $this->content,

        ]);

        $this->dispatch('refreshComponent', data: $this->body);

        // Set the loading state back to false after processing

    }
    
    // public function refreshComponent()
    // {
    //     dd('here');
    //     $this->dispatch('refreshComponent', data: $this->body);

    // }






    public function saveUploadedDocument()
    {
        // dd($this->file);
        dd(Request::all());

        $user = auth()->user()->contents()->find($this->contentTitle->id);
        $this->title;
        $this->content;
        $this->contentTitle->id;
        $user->documents()->create([
            'title' =>  'title',
            'content' =>  $this->file,
            // 'title' =>  $this->title,

        ]);

        // if ('pdf') {
        //     $pdfFilePath = 'path/to/your/file.pdf';

        //     // Extract text from the PDF
        //     $text = (new Pdf())->setPdf($pdfFilePath)->text();

        //     // Output the extracted text
        //     echo $text;
        // } elseif ('dox') {
        //     $docxFilePath = 'path/to/your/file.docx';

        //     // Load the DOCX file
        //     $phpWord = IOFactory::load($docxFilePath);

        //     // Get the plain text content from the DOCX
        //     $plainText = $phpWord->getPlainText();

        //     // Output the plain text content
        //     echo $plainText;
        // }
    }

    public function render()
    {
        return view('livewire.upload-document');
    }
}
