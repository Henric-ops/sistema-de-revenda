<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('compras.pagamentos', 'user')
            ->latest()
            ->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'observacoes' => 'nullable|string'
        ]);

        try {

            DB::transaction(function () use ($request) {

                $celular = preg_replace('/\D/', '', $request->celular);

                // cria usuário SEM senha automática enviada
                $user = User::create([
                    'name' => $request->nome,
                    'phone' => $celular,
                    'password' => Hash::make(Str::random(8)), // senha existe, mas não é enviada
                    'tipo' => 'cliente'
                ]);

                Cliente::create([
                    'user_id' => $user->id,
                    'nome' => $request->nome,
                    'celular' => $request->celular,
                    'observacoes' => $request->observacoes ?? null,
                    'ativo' => true,
                ]);

            });

            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente cadastrado com sucesso!');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('compras.pagamentos');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $celular = preg_replace('/\D/', '', $request->celular);

        $cliente->update([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'observacoes' => $request->observacoes,
        ]);

        if ($cliente->user) {
            $cliente->user->update([
                'name' => $request->nome,
                'phone' => $celular,
            ]);
        }

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->user) {
            $cliente->user->delete();
        }

        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente deletado com sucesso!');
    }

    public function reenviarAcesso(Cliente $cliente)
    {
        if (!$cliente->user) {
            return redirect()
                ->route('clientes.index')
                ->with('error', 'Cliente sem usuário vinculado.');
        }

        $celular = preg_replace('/\D/', '', $cliente->celular);

        $senha = Str::random(8);
        $cliente->user->update([
            'password' => Hash::make($senha),
        ]);

        $numero = $celular;

        if (!str_starts_with($numero, '55')) {
            $numero = '55' . $numero;
        }

        $mensagem = urlencode(
            "Olá {$cliente->nome}! 👋\n\n" .
            "Seu acesso foi reenviado:\n\n" .
            "📱 Login: {$celular}\n" .
            "🔑 Nova Senha: {$senha}\n\n" .
            "Acesse o sistema e altere sua senha após o primeiro login."
        );

        $whatsappUrl = "https://wa.me/{$numero}?text={$mensagem}";

        return redirect($whatsappUrl);
    }
}