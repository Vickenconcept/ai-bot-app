<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Content;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = $request->input('query'); // Get the user input from the query parameter
        $contents = Content::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->latest()->get();

        return view('contents.content', compact('contents'));
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
        $title = 'content #' . rand(0, 99999);
        // $defaultBot = Bot::where('name', 'bot')->first();

        auth()->user()->contents()->create(['title' => $title]);

        return back()->with('success', 'content created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content, Request $request)
    {

        if (!$content->id) {

            return redirect()->route('contents.index');
        }

        $query = request()->input('query');

        $body = Document::where('content_id', $content->id)
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
            ->latest()
            ->get();

        $contentTitle = Content::findOrfail($content->id);
        $contents =  Content::latest()->get();

        return view('contents.show', compact('body', 'contentTitle', 'contents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateName(Request $request)
    {
        $title = $request->input('title');
        $contentId = $request->input('contentId');
        // dd($contentId);
        $user = auth()->user();

        // Find the specific content by ID
        $contentToUpdate = $user->contents()->find($contentId);

        if (!$contentToUpdate) {
            return redirect()->back()->with('error', 'content not found.');
        }

        // Update the title of the content
        $contentToUpdate->title = $title;
        $contentToUpdate->update();

        return redirect()->back()->with('success', 'content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($content)
    {
        $user = auth()->user();
        
        $content = Content::find($content);
        
        $content->delete();

        return redirect()->to('contents')->with('success', 'content deleted successfully.');
    }
}
