<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\IOFactory;
use Goutte\Client;

class UploadDocument extends Component
{

    use WithFileUploads;

    public $file, $textContent, $webUrl;

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
        $user->documents()->create([
            'title' =>  $this->title,
            'content' =>  $this->content,

        ]);

        $this->dispatch('refreshComponent', data: $this->body);


    }

    public function saveUploadedDocument()
    {
        $this->validate([
            'file' => 'required|mimes:pdf,docx|max:2048', 
        ]);

        if ($this->file->getClientOriginalExtension() === 'pdf') {
            $binpath = 'C:/Program Files/Git/mingw64/bin/pdftotext';
            $this->textContent = Pdf::getText($this->file->getRealPath(), $binpath);

        } elseif ($this->file->getClientOriginalExtension() === 'docx') {
            $doc = IOFactory::load($this->file->getRealPath());


            $doc = IOFactory::load($this->file->getRealPath());
            foreach ($doc->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $textElement) {
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $this->textContent .= $textElement->getText();
                            }
                        }
                    }
                }
            }
        }


        $user = auth()->user()->contents()->find($this->contentTitle->id);
       
        $user->documents()->create([
            'title' =>  'uploaded ' . rand(0, 99999),
            'content' =>   $this->textContent,

        ]);
        $this->dispatch('refreshComponent', data: $this->body);
        return;

    }


    public function scrapeWebsite()
    {
        // $url = 'https://me.vixblock.com.ng/index.html/';  // Replace with the URL you want to scrape

        $this->validate([
            'webUrl' => 'required|url',
        ]);

        $client = new Client();
        $crawler = $client->request('GET', $this->webUrl);

        $this->textContent = $crawler->filter('body')->text();
        // $cleanedText = preg_replace("/[^a-zA-Z0-9\s]/", "", $mainText);
        // dd($this->textContent);

        $user = auth()->user()->contents()->find($this->contentTitle->id);
        
        // $content = Str::limit($this->textContent, 255);
        // $this->validate(
        //     [
        //         'content' => 'max:255', 
        //     ]
        //     );

        $user->documents()->create([
            'title' =>  'uploaded ' . rand(0, 99999),
            'content' =>   $this->textContent,

        ]);
        $this->dispatch('refreshComponent', data: $this->body);
        return;
        
    }



    public function render()
    {
        return view('livewire.upload-document');
    }
}
