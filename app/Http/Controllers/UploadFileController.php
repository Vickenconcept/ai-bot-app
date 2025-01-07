<?php

namespace App\Http\Controllers;

use App\Services\ChatGptService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\IOFactory;
use Goutte\Client;

class UploadFileController extends Controller
{
    protected $textContent;

    public function __invoke(Request $request, ChatGptService $chatGptService)
    {
        try {
            //code...
        
        
        $request->validate([
            'file' => 'required|mimes:pdf,docx|max:10000',
        ]);
        
        if ($request->file->getClientOriginalExtension() === 'pdf') {
            $binpath = 'C:/Program Files/Git/mingw64/bin/pdftotext';

            $this->textContent = Pdf::getText($request->file->getRealPath(), $binpath);
        } elseif ($request->file->getClientOriginalExtension() === 'docx') {
            $doc = IOFactory::load($request->file->getRealPath());


            $doc = IOFactory::load($request->file->getRealPath());
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


        $user = auth()->user()->contents()->find($request->content_id);
        
        $document = $user->documents()->create([
            'title' =>  'uploaded ' . rand(0, 99999),
            'content' =>   $res,

        ]);

        

        if ($document) {
            return response()->json([
                'success' => true,
                'message' => 'File uploaded and processed successfully.',
                'document' => $document
            ]);
        }

    } catch (\Exception $e) {
        //throw $th;
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    
    }
}
