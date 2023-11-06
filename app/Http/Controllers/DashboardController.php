<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $usersContacts = Conversation::where('type','guest')->latest()->get() ;
    
        return view('dashboard', compact('usersContacts'));
    }
}
