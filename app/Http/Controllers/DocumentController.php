<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $id = $request->input('content_id');
        $data = $request->validate([
            'content_id' => 'required',
            'title' => 'required',
            'content' => 'required'

        ]);
        $content = Content::findOrfail($id);

        $content->documents()->create($data);

        return redirect()->back()->with('success','Document  created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($document)
    {

        $document = Document::findorfail($document);
        return view('document', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $title = $request->input('title');
        $id = $request->input('id');
        // dd($id);

        $document = Document::find($id);
        $document->title = $title;
        $document->update();
        // $document;
        // dd($document->title);
        return redirect()->back()->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy($document)
    {
        // Log::info('Document info:', ['document' => $document]);
        try {
            Document::whereIn('id', explode(',', $document))->delete();
            session()->flash('success', 'Items deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting items: ' . $e->getMessage());
        }
         

        return redirect('contents')->with('success', 'Document deleted successfully.');
    }
}
