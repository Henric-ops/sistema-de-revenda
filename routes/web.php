<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AuthController;

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

    Route::post('/pagamentos', [PagamentoController::class, 'store'])
        ->name('pagamentos.store');

    Route::delete('/pagamentos/{pagamento}', [PagamentoController::class, 'destroy'])
        ->name('pagamentos.destroy');

    Route::get('/relatorios', [RelatorioController::class, 'index'])
        ->name('relatorios.index');

    Route::get('/relatorios/inadimplentes', [RelatorioController::class, 'inadimplentes'])
        ->name('relatorios.inadimplentes');

    Route::get('/relatorios/pagamentos', [RelatorioController::class, 'pagamentos'])
        ->name('relatorios.pagamentos');

});




