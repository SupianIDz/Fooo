<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('auth');
    }

    /**
     * @param  Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return redirect()->route('map.network');
        }

        return redirect()->back()->withErrors([
            'Invalid credentials.',
        ]);
    }
}
