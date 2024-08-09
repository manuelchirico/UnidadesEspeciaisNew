<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionarios.index', compact('funcionarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:funcionarios',
            'contacto' => 'required|string|max:255',
            'tipo' => 'required|in:admin,funcionario',
            'password' => 'required|string|min:8',
        ]);

        Funcionario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'contacto' => $request->contacto,
            'tipo' => $request->tipo,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário registrado com sucesso');
    }
}
