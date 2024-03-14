<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('index'); // Redirect to home or dashboard
        }

        return redirect()->route('login')->with('error', 'Credenziali non valide');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crea un nuovo utente
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Illuminate\Support\Facades\Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect()->route('index')->with('success', 'Registrazione completata con successo');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

