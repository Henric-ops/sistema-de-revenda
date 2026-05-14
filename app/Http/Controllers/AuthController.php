<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = preg_replace('/\D/', '', $request->login); // normaliza
        $password = $request->password;

        // 🔎 detecta email
        $isEmail = filter_var($request->login, FILTER_VALIDATE_EMAIL);

        // 🔐 monta credenciais
        if ($isEmail) {

            $credenciais = [
                'email' => $request->login,
                'password' => $password,
            ];

        } else {

            $credenciais = [
                'phone' => $login,
                'password' => $password,
            ];
        }

        if (Auth::attempt($credenciais)) {

            $request->session()->regenerate();

            $user = auth()->user();

            // 👑 ADMIN
            if ($user->tipo === 'admin') {
                return redirect()->route('dashboard');
            }

            // 👤 CLIENTE
            if ($user->tipo === 'cliente') {

                $cliente = $user->cliente;

                if (!$cliente) {
                    Auth::logout();
                    return back()->with('erro', 'Cliente não vinculado.');
                }

                if (!$cliente->ativo) {
                    Auth::logout();
                    return back()->with('erro', 'Acesso bloqueado.');
                }

                return redirect()->route('cliente.dashboard');
            }

            Auth::logout();
            return back()->with('erro', 'Tipo inválido.');
        }

        return back()->with('erro', 'Login ou senha inválidos');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
