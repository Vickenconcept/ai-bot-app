<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reseller');
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
        $referrer = User::whereUsername(session()->pull('referrer'))->first();

        

        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'username' => 'sometimes',
                'role' => 'sometimes',
                'referrer_id' => 'sometimes'
            ]);
            $data['role'] = 'user';
            $data['referrer_id'] = $referrer ? $referrer->id : null;
            // dd($data);
            $user = User::create($data);
            $owner = auth()->user();
            $owner->resellers()->create([
                'resell_id' => $user->id,
            ]);
            // Your code that might throw the duplicate entry error
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception
            if ($e->getCode() == 23000) {
                return redirect()->back()->withInput()->withErrors(['error' => 'A duplicate entry error occurred. Please try again.']);
            }
        
        }

        $userId = $user->id;


        if ($user) {
            $message = $user->bots()->create([
                'name' => 'bot',
                'personality' => '',
                'description' => 'an intelligent bot , for all times',
                'knowledge' => '',
                'model' => 'gpt-4',
            ]);
        }

        return back()->with('success','User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reseller $reseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reseller $reseller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reseller $reseller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success','User Deleted Successfully');
    }
}
