<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteDashboardController;



Route::redirect('/', '/login'); // Redireciona para login
Route::get('/clientes/{cliente}/reenviar-acesso', [ClienteController::class, 'reenviarAcesso'])
    ->name('clientes.reenviar-acesso');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'auth']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| RELATÓRIOS PDF
|--------------------------------------------------------------------------
*/

Route::get('/relatorios/compras-periodo', [RelatorioController::class, 'comprasPeriodo'])
    ->name('relatorios.compras-periodo');

Route::get(
    '/relatorios/inadimplentes/pdf',
    [RelatorioController::class, 'inadimplentesPdf']
)->name('relatorios.inadimplentes.pdf');

Route::get(
    '/relatorios/pagamentos/pdf',
    [RelatorioController::class, 'pagamentosPdf']
)->name('relatorios.pagamentos.pdf');

/*
|--------------------------------------------------------------------------
| ÁREA DO CLIENTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'cliente.ativo'])->prefix('cliente')->group(function () {

    Route::get(
        '/dashboard',
        [ClienteDashboardController::class, 'index']
    )->name('cliente.dashboard');

});

/*
|--------------------------------------------------------------------------
| ÁREA ADMINISTRATIVA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Clientes
    Route::resource('clientes', ClienteController::class);

    // Compras
    Route::resource('compras', CompraController::class);

    // Pagamentos
    Route::resource('pagamentos', PagamentoController::class);

    // Relatórios
    Route::get('/relatorios', [RelatorioController::class, 'index'])
        ->name('relatorios.index');

    Route::get('/relatorios/inadimplentes', [RelatorioController::class, 'inadimplentes'])
        ->name('relatorios.inadimplentes');

    Route::get('/relatorios/pagamentos', [RelatorioController::class, 'pagamentos'])
        ->name('relatorios.pagamentos');

    Route::get(
        '/clientes/{cliente}/usuario',
        [ClienteController::class, 'usuario']
    )->name('clientes.usuario');// Rota para exibir formulário de criação de usuário a partir do cliente

    Route::post(
        '/clientes/{cliente}/usuario',
        [ClienteController::class, 'criarUsuario']
    )->name('clientes.usuario.salvar');// Rota para criar usuário a partir do cliente

});