<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referrals = User::where('referrer_id' , auth()->user()->id)->latest()->get();
        // dd($referrals);
        return view('account',compact('referrals'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $access = $request->input('access');
        $user = User::find($id);
        if ($access === 'owner') {
            $user->referrer_id = null;
            $user->update();

        }elseif($access === 'member'){
            $user->referrer_id = auth()->user()->id;
            $user->update();
        }
        return redirect()->to('account')->with('success', 'Access updated successfully.');

        
        dd($access);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->to('account')->with('success', 'member deleted successfully.');
    }
}
