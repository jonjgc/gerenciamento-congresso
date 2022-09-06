<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GerenciarTrabalhosController extends Controller
{
    public function visualizar($id)
    {
        $trabalho = Trabalho::query()->with('user')->find($id);
        if (auth()->user()->role_id == Role::ADMIN)
            $route = 'avaliar-trabalho';
        if (auth()->user()->role_id == Role::CORRETOR)
            $route = 'corretor-avaliar-trabalho';
        if (auth()->user()->role_id == Role::EDITOR)
            $route = 'editor-avaliar-trabalho';

        return view('admin.visualizar-trabalho', compact('trabalho', 'route'));
    }

    public function avaliar($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nota' => 'required|min:0|max:10'
            ],
            [
                'nota.required' => 'É necessário inserir a Nota!',
                'nota.max' => 'A nota maxima é 10',
                'nota.min' => 'A nota minima é 0',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $trabalho = Trabalho::query()->find($id);

        if (is_null($trabalho->nota)) {
            $trabalho->nota = $request->nota;
            $trabalho->save();
        }
        if (auth()->user()->role_id == Role::CORRETOR) {
            $rota = 'corretor-visualizar-trabalho';
        }
        if (auth()->user()->role_id == Role::EDITOR) {
            $rota = 'editor-visualizar-trabalho';
        }
        return redirect()->route($rota, $trabalho->id)->with('message', 'Nota inserida com Sucesso');
    }
}
