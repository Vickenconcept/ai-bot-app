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
    public function register(CreateUserRequest $request)
    {

        $user = User::create($request->validated());

        return $request->wantsJson()
            ? Response::api(['data' => $user])
            : to_route('register.success');
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
