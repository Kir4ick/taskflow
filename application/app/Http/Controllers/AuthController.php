<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController
{
    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function login(AuthRequest $request): RedirectResponse
    {
        $result = Auth::attempt($request->only('email', 'password'));
        if (!$result) {
            return redirect(route('login'));
        }

        return redirect(route('home'));
    }

    public function loginByRememberToken(Request $request): RedirectResponse
    {
        if (!$request->cookie('remember_token')) {
            return redirect(route('login'));
        }

        $user = User::query()
            ->where('remember_token', $request->post('remember_token'))
            ->first();
        if (!$user) {
            return redirect(route('login'));
        }

        Auth::loginUsingId($user->id);

        return redirect(route('home'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
