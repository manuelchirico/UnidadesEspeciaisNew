<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::all();
        return view('pessoas.index', compact('pessoas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:pessoas',
            'contacto' => 'required',
            'tipo' => 'required',
            'password' => 'required|min:6',
        ]);

        Pessoa::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'contacto' => $request->contacto,
            'tipo' => $request->tipo,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa criada com sucesso');
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();

        return redirect()->route('pessoas.index')->with('success', 'Pessoa deletada com sucesso');
    }

    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return response()->json($pessoa);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'contacto' => 'required',
            'tipo' => 'required',
        ]);

        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'contacto' => $request->contacto,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa atualizada com sucesso');
    }
}
