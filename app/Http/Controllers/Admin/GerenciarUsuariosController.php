<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GerenciarUsuariosController extends Controller
{
    public function listar()
    {
        $users = User::query()->orderBy('updated_at', 'desc')->paginate(15);
        return view('admin.gerenciar-usuarios', compact('users'));
    }

    public function visualizarUsuario($id)
    {
        $user = User::find($id);

        return view('admin.visualizar-usuario', compact('user'));
    }

    public function editarUsuario($id)
    {
        $user = User::find($id);
        return view('admin.editar-usuario', compact('user'));
    }

    public function atualizarUsuario(Request $request, int $id)
    {
        $user = User::find($id);
        if ($user->role_id == Role::ADMIN && auth()->user() != $user) { // Admin
            return redirect()->back()->withErrors(['error' => 'Não é possivel alterar outro Admin!']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'role_id' => 'required|integer',
            ],
            [
                'name.required' => 'É necessário inserir um nome!',
                'email.required' => 'É necessário inserir um Email!',
                'role_id.required' => 'É necessário selecionar um tipo para o Usuário!',
                'email.email' => 'É preciso inserir um email Valido!',
                'max' => 'Quantidade de caracteres ultrapassada, o nome deve ter menos que 254 caracteres!',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('gerenciar-usuarios')->with('message', 'Editado com Sucesso!');
    }

    public function deletarUsuario($id)
    {
        $user = User::find($id);
        if ($user->role_id == Role::ADMIN) {
            return redirect()->back()->withErrors(['error' => 'Não é possivel deletar um Admin!']);
        }

        $user->delete();

        return redirect()->route('gerenciar-usuarios')->with('message', 'Deletado com Sucesso!');
    }
}
