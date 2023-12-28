<?php

namespace App\Livewire;

use App\Services\ChatGptService;
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

    public $body,
        $contentTitle,
        $title,
        $content,
        $updatedContent,
        $totalDocumentCount,
        $documentLimit;


    public function mount($body, $contentTitle)
    {
        $this->body = $body;
        $this->contentTitle = $contentTitle;
        $contents = auth()->user()->contents()->withCount('documents')->get();
        $this->totalDocumentCount = $contents->sum('documents_count');
        $this->documentLimit = 100;
    }
    public function saveWrittenDocument(ChatGptService $chatGptService)
    {
        $user = auth()->user()->contents()->find($this->contentTitle->id);
        $this->title;
        $this->content;
        $this->contentTitle->id;




        if ($this->totalDocumentCount >= $this->documentLimit) {
            return redirect()->back()->with('error', 'You have reached the document limit of 100 for this content.');
        }

        $name = '';
        $document = '';
        $model = 'gpt-4';
        $system = 'You are a knowledgeable assistant for summary';
        $combinedPrompt = "summarize in bullet points, removing filler words, don't repet yourself: " . $this->content;


        $res = $chatGptService->generateContent($name, $model, $system, $combinedPrompt, $document);

        $validated = $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $document = $user->documents()->create([
            'title' =>  $this->title,
            'content' =>  $res,

        ]);

        if ($document) {

            $this->dispatch('refreshComponent', data: $this->body);
        }
    }

    public function saveUploadedDocument(ChatGptService $chatGptService)
    {
        $this->validate([
            'file' => 'required|mimes:pdf,docx|max:2048',
        ]);
        // dd($this->file);

        if ($this->file->getClientOriginalExtension() === 'pdf') {
            // $binpath = 'C:/Program Files/Git/mingw64/bin/pdftotext';
            $binpath = base_path('bin/pdftotext');

            $command = "which pdftotext";
            $pdftotext_path = shell_exec($command);
            dd($pdftotext_path);
            dd($binpath);
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

        $cleanInvalidUtf8 = mb_convert_encoding($this->textContent, 'UTF-8', 'UTF-8');


        $name = '';
        $document = '';
        $model = 'gpt-4';
        $system = 'You are a knowledgeable assistant for summary';
        $combinedPrompt = "summarize in bullet points, removing filler words, don't repet yourself: " . $cleanInvalidUtf8;


        $res = $chatGptService->generateContent($name, $model, $system, $combinedPrompt, $document);


        $user = auth()->user()->contents()->find($this->contentTitle->id);

        $document = $user->documents()->create([
            'title' =>  'uploaded ' . rand(0, 99999),
            'content' =>   $res,

        ]);


        if ($document) {

            $this->dispatch('refreshComponent', data: $this->body);
        }

        return;
    }


    public function scrapeWebsite(ChatGptService $chatGptService)
    {

        $this->validate([
            'webUrl' => 'required|url',
        ]);

        $client = new Client();
        $crawler = $client->request('GET', $this->webUrl);

        $this->textContent = $crawler->filter('body')->text();
        $cleanedText = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->textContent);


        $name = '';
        $document = '';
        $model = 'gpt-4';
        $system = 'You are a knowledgeable assistant for summary';
        $combinedPrompt = "summarize in bullet points, removing filler words, don't repet yourself: " . $cleanedText;


        $res = $chatGptService->generateContent($name, $model, $system, $combinedPrompt, $document);
        // dd($res);

        $user = auth()->user()->contents()->find($this->contentTitle->id);

        $document = $user->documents()->create([
            'title' =>  'uploaded ' . rand(0, 99999),
            'content' =>   $res,

        ]);

        if ($document) {

            $this->dispatch('refreshComponent', data: $this->body);
        }

        return;
    }



    public function render()
    {
        return view('livewire.upload-document');
    }
}
