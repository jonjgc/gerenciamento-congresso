<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\GerenciarTrabalhosController;
use App\Http\Controllers\Admin\GerenciarUsuariosController;
use App\Http\Controllers\Admin\GerenciarUniversidadesController;
use App\Http\Controllers\Editores\EditoresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParticipantesController;
use App\Models\Role;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Rota inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

//rotas de autenticação
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['checkRole:' . Role::ADMIN])->group(function () {
        //Admin
        Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin-dashboard');
        //gerenciar usuário
        Route::get('/users', [GerenciarUsuariosController::class, 'listar'])->name('gerenciar-usuarios');
        Route::get('/users/{id}/visualizar', [GerenciarUsuariosController::class, 'visualizarUsuario'])->name('visualizar-usuario');
        Route::get('/users/{id}/editar', [GerenciarUsuariosController::class, 'editarUsuario'])->name('editar-usuario');
        Route::put('/users/{id}/atualizar', [GerenciarUsuariosController::class, 'atualizarUsuario'])->name('atualizar-usuario');
        Route::delete('/users/{id}/delete', [GerenciarUsuariosController::class, 'deletarUsuario'])->name('deletar-usuario');

        //trabalhos
        Route::get('/trabalhos/{id}/visualizar', [GerenciarTrabalhosController::class, 'visualizar'])->name('visualizar-trabalho');
        Route::post('/trabalhos/{id}/avaliar', [GerenciarTrabalhosController::class, 'avaliar'])->name('avaliar-trabalho');

        //universidades
        Route::get('/universidades', [GerenciarUniversidadesController::class, 'listar'])->name('gerenciar-universidades');
        Route::get('/universidades/create', [GerenciarUniversidadesController::class, 'criarUniversidade'])->name('criar-universidade-view');
        Route::post('/universidades/create', [GerenciarUniversidadesController::class, 'salvarUniversidade'])->name('criar-universidade');
        Route::post('/universidades/{id}/ativar', [GerenciarUniversidadesController::class, 'ativarUniversidade'])->name('ativar-universidade');
    });

    Route::middleware(['checkRole:' . Role::PARTICIPANTE])->group(function () {
        //participantes
        Route::get('/participantes/dashboard', [ParticipantesController::class, 'dashboard'])->name('participante-dashboard');
        Route::get('/participantes/trabalho', [ParticipantesController::class, 'enviarTrabalho'])->name('enviar-trabalho-view');
        Route::post('/participantes/trabalho', [ParticipantesController::class, 'enviartrabalhoPost'])->name('enviar-trabalho');
        Route::get('/participantes/trabalho/editar/{id}', [ParticipantesController::class, 'editarTrabalho'])->name('editar-trabalho-view');
        Route::put('/participantes/trabalho/{id}', [ParticipantesController::class, 'editartrabalhoPost'])->name('editar-trabalho');
    });

    Route::middleware(['checkRole:' . Role::EDITOR])->group(function () {
        //Editor
        Route::get('/editor', [HomeController::class, 'index'])->name('editor-dashboard');
        Route::get('/editor/trabalhos/{id}/visualizar', [GerenciarTrabalhosController::class, 'visualizar'])->name('editor-visualizar-trabalho');
        Route::post('/editor/trabalhos/{id}/avaliar', [GerenciarTrabalhosController::class, 'avaliar'])->name('editor-avaliar-trabalho');
    });

    Route::middleware(['checkRole:' . Role::CORRETOR])->group(function () {
        //Corretor
        Route::get('/corretor', [HomeController::class, 'index'])->name('corretor-dashboard');
        Route::get('/corretor/trabalhos/{id}/visualizar', [GerenciarTrabalhosController::class, 'visualizar'])->name('corretor-visualizar-trabalho');
        Route::post('/corretor/trabalhos/{id}/avaliar', [GerenciarTrabalhosController::class, 'avaliar'])->name('corretor-avaliar-trabalho');
    });
});
