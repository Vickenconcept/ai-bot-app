<?php

namespace App\Http\Controllers;

use App\Mail\Invite as MailInvite;
use App\Notifications\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = $request->input('email');
        $access = $request->input('access');
        $request->validate([
            'email' => 'required|email',
            'access' => 'required',
        ]);
        $user = auth()->user();

        dispatch(function () use($email, $user, $access){
            Mail::to($email)->send(new MailInvite($user->name, $access, $email));
        });

        return redirect()->back()->with('success', 'Invite sent successfuly');
    }
}
