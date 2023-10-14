<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    public function showRegistrationForm(Request $request)
    {
        $referralToken = $request->query('ref');

        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // $referrer = $request->session()->get('referrer');
        $referrer = User::whereUsername(session()->pull('referrer'))->first();

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'username' => 'sometimes',
            'referrer_id' => 'sometimes'
        ]);
        $data['referrer_id'] = $referrer ? $referrer->id : null;
        // dd($data);

        $user = User::create($data);

        Auth::login($user);

        $user = auth()->user();


        $message = $user->bots()->create([
            'name' => 'bot',
            'personality' => '',
            'description' => 'an intelligent bot , for all times',
            'knowledge' => '',
            'model' => 'gpt-4',
        ]);


        auth()->logout();
        return $request->wantsJson()
            ? Response::api(['data' => $user])
            : to_route('login');
    }

    public function login(CreateUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $request->wantsJson()
                ? Response::api('Invalid Credentials', Response::HTTP_BAD_REQUEST)
                : back()->with('invalidCredential', 'Invalid Credentials');
        }

        return  to_route('home');
    }

    public function logout(Request $request)
    {

        if ($request->wantsJson()) {

            return Response::api('logged out successfully');
        }

        Auth::logout();

        return to_route('login');
    }
}
