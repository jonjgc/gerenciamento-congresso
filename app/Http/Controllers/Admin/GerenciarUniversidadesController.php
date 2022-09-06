<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Universidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GerenciarUniversidadesController extends Controller
{
    public function listar()
    {
        $universidades = Universidade::query()->orderBy('updated_at', 'desc')->paginate(15);
        return view('admin.universidade.gerenciar-univ', compact('universidades'));
    }

    public function criarUniversidade()
    {
        return view('admin.universidade.criar-universidade');
    }

    public function salvarUniversidade(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required|string|max:255',
                'sigla' => 'required|string|max:255',
            ],
            [
                'nome.required' => 'É necessário inserir um nome!',
                'sigla.required' => 'É necessário inserir uma sigla!',
                'nome.max' => 'Quantidade de caracteres ultrapassada, o Nome deve ter menos que 254 caracteres!',
                'sigla.max' => 'Quantidade de caracteres ultrapassada, a Sigla deve ter menos que 254 caracteres!',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $universidade = new Universidade();

        $universidade->nome = $request->nome;
        $universidade->sigla = $request->sigla;
        $universidade->ativo = true;

        $universidade->save();

        return redirect()->route('gerenciar-universidades')->with('message', 'Universidade Criada Com Sucesso!');
    }

    public function ativarUniversidade($id)
    {
        $universidade = Universidade::findOrFail($id);
        $universidade->ativo = !$universidade->ativo;
        $universidade->save();
        if ($universidade->ativo) {
            return redirect()->route('gerenciar-universidades')->with('message', 'A universidade foi Ativada!');
        } else {
            return redirect()->route('gerenciar-universidades')->withErrors(['message' => 'A universidade foi desativada!']);
        }
    }
}
