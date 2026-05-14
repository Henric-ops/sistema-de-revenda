<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AuthController;



Route::redirect('/', '/login');// Redireciona para a página de login

Route::get('/relatorios/compras-periodo', [RelatorioController::class, 'comprasPeriodo'])
    ->name('relatorios.compras-periodo');// Rota para exibir o formulário de relatório de compras por período

Route::get(
    '/relatorios/inadimplentes/pdf',
    [RelatorioController::class, 'inadimplentesPdf']
)->name('relatorios.inadimplentes.pdf');// Rota para gerar PDF do relatório de inadimplentes

Route::get(
    '/relatorios/pagamentos/pdf',
    [RelatorioController::class, 'pagamentosPdf']
)->name('relatorios.pagamentos.pdf');// Rota para gerar PDF do relatório de pagamentos


Route::get('/login', [AuthController::class, 'login'])
    ->name('login');// Rota para exibir o formulário de login

Route::post('/login', [AuthController::class, 'auth']);// Rota para processar o login

Route::post('/logout', [AuthController::class, 'logout'])// Rota para processar o logout
    ->name('logout');


Route::middleware('auth')->group(function () {// Rotas protegidas por autenticação

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('clientes', ClienteController::class);

    Route::resource('compras', CompraController::class);

    Route::resource('pagamentos', PagamentoController::class);

    Route::get('/relatorios', [RelatorioController::class, 'index'])
        ->name('relatorios.index');

    Route::get('/relatorios/inadimplentes', [RelatorioController::class, 'inadimplentes'])
        ->name('relatorios.inadimplentes');

    Route::get('/relatorios/pagamentos', [RelatorioController::class, 'pagamentos'])
        ->name('relatorios.pagamentos');

});




