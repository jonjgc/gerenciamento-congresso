<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParticipantesController extends Controller
{
    public function dashboard()
    {
        $trabalho = auth()->user()->trabalhos->first();
        return view('participantes.participantes-dashboard', compact('trabalho'));
    }

    public function enviarTrabalho()
    {
        if (auth()->user()->trabalhos->count() > 0) {
            return redirect()
                ->route('participante-dashboard')
                ->withErrors(['error' => "Não é possivel enviar mais de um trabalho"]);
        }

        return view('participantes.enviar-trabalho');
    }

    public function enviartrabalhoPost(Request $request)
    {
        if (auth()->user()->role_id != Role::PARTICIPANTE) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Apenas Usuários do tipo Participante podem Enviar Trabalhos'])
                ->withInput();
        }

        $validator = Validator::make(
            $request->all(),
            [
                'titulo' => 'required|string|max:255',
                'autor' => 'required|string|max:255',
                'anexo' => 'required|mimes:pdf|max:8192'
            ],
            [
                'titulo.required' => 'É necessário inserir um Titulo!',
                'autor.required' => 'É necessário inserir um Autor!',
                'anexo.required' => 'É necessário enviar um arquivo do tipo PDF para ser avaliado!',
                'titulo.max' => 'Quantidade de caracteres ultrapassada, o Campo Titulo deve ter menos que 254 caracteres!',
                'autor.max' => 'Quantidade de caracteres ultrapassada, o Campo Autor deve ter menos que 254 caracteres!',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $uploadedFile = $request->anexo;
        $filename = time() . $uploadedFile->getClientOriginalName();
        $caminho = "trabalhos/" . auth()->user()->id . "/";

        Storage::disk('public')->putFileAs(
            $caminho,
            $uploadedFile,
            $filename
        );

        $trabalho = new Trabalho();
        $trabalho->user_id = auth()->user()->id;
        $trabalho->titulo = $request->titulo;
        $trabalho->autor = $request->autor;
        $trabalho->nome_original = $uploadedFile->getClientOriginalName();
        $trabalho->nome = $filename;
        $trabalho->caminho = $caminho;

        $trabalho->save();

        return redirect()
            ->route('participante-dashboard')
            ->with('message', 'Trabalho enviado com sucesso!');
    }

    public function editarTrabalho($id)
    {
        $trabalho = Trabalho::with('user')->findOrFail($id);
        if ($trabalho->user != auth()->user() || !is_null($trabalho->nota)) {
            return redirect()
                ->route('participante-dashboard')
                ->withErrors(['error' => "Não foi possivel editar esse trabalho"]);
        }
        return view('participantes.editar-trabalho', compact('trabalho'));
    }

    public function editartrabalhoPost($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'titulo' => 'required|string|max:255',
                'autor' => 'required|string|max:255',
                'anexo' => 'mimes:pdf|max:8192'
            ],
            [
                'titulo.required' => 'É necessário inserir um Titulo!',
                'autor.required' => 'É necessário inserir um Autor!',
                'titulo.max' => 'Quantidade de caracteres ultrapassada, o Campo Titulo deve ter menos que 254 caracteres!',
                'autor.max' => 'Quantidade de caracteres ultrapassada, o Campo Autor deve ter menos que 254 caracteres!',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $trabalho = Trabalho::find($id);
        $trabalho->titulo = $request->titulo;
        $trabalho->autor = $request->autor;

        if ($request->hasFile('anexo')) {
            Storage::disk('public')->delete("trabalhos/" . auth()->user()->id . "/" . $trabalho->nome);
            $uploadedFile = $request->anexo;
            $filename = time() . $uploadedFile->getClientOriginalName();
            $caminho = "trabalhos/" . auth()->user()->id . "/";

            Storage::disk('public')->putFileAs(
                $caminho,
                $uploadedFile,
                $filename
            );

            $trabalho->nome_original = $uploadedFile->getClientOriginalName();
            $trabalho->nome = $filename;
            $trabalho->caminho = $caminho;
        }
        $trabalho->save();

        return redirect()
            ->route('participante-dashboard')
            ->with('message', 'Trabalho Editado com Sucesso!');
    }
}
