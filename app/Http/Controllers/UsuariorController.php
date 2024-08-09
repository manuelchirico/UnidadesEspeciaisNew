<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariorController extends Controller
{
    public function showRegisterForm()
    {
        return view('users.register'); // Exibir a tela de registro
    }

    public function register(Request $request)
{
    // Validação dos dados de entrada
    $validator = Validator::make($request->all(), [
        'nome' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'senha' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Criação do usuário
    $user = new User();
    $user->nome = $request->nome;
    $user->email = $request->email;
    $user->senha = Hash::make($request->senha); // Senha criptografada com Bcrypt
    $user->save();

    // Redirecionamento após registro bem-sucedido
    return redirect()->route('login')->with('success', 'Usuário registrado com sucesso!');
}
}
