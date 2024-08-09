<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pessoa;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida, redirecionar para o dashboard
            return redirect()->intended('dashboard');
        }

        // Autenticação falhou, redirecionar de volta para o formulário de login com um erro
        return redirect()->back()->withErrors(['email' => 'As credenciais não correspondem aos nossos registros.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}