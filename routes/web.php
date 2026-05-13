<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AuthController;

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


Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'auth']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

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




