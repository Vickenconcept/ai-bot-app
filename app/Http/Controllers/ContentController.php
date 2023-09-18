<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents =  Content::latest()->get();
        return view('contents.content' ,compact('contents'));
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

        auth()->user()->contents()->create(['title' => $title]);

        return back()->with('success', 'content created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {

        if (!$content->id) {
         
            return redirect()->route('contents.index');
        }
        
        $body = Content::findOrfail($content->id)->documents()->latest()->get();
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
    public function update(Request $request, Content $content)
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
    public function destroy( $content)
    {
        // $user = auth()->user();

        
        $content = Content::find($content);
        $content->delete();

        return redirect()->to('contents')->with('success', 'content deleted successfully.');
    }
}
