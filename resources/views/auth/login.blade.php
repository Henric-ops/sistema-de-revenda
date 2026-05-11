<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Lora:wght@400;500;600&display=swap"
        rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="login-body">

    <div class="login-container">

        {{-- LADO ESQUERDO --}}
        <div class="login-banner">

            <div>

                <h1>
                    Cosmetiq
                </h1>

                <p>
                    Sistema inteligente para controle financeiro de clientes e vendas.
                </p>

            </div>

        </div>

        {{-- FORM --}}
        <div class="login-form-side">

            <div class="login-card">

                <h2>
                    Bem-vinda
                </h2>

                <p>
                    Faça login para continuar.
                </p>

                @if(session('erro'))

                    <div class="alert alert-danger">

                        {{ session('erro') }}

                    </div>

                @endif

                <form action="/login" method="POST" class="custom-form">

                    @csrf

                    <div class="form-group">

                        <label>
                            E-mail
                        </label>

                        <input type="email" name="email" placeholder="Digite seu e-mail">

                    </div>

                    <div class="form-group">

                        <label>
                            Senha
                        </label>

                        <input type="password" name="password" placeholder="Digite sua senha">

                    </div>

                    <button type="submit" class="btn-primary-custom w-100">

                        <i class="bi bi-box-arrow-in-right"></i>

                        Entrar

                    </button>

                </form>

            </div>

        </div>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>