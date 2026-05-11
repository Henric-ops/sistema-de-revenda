<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cosmetiq | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Lora:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="login-body-cosmetiq">

    <div class="login-wrapper">

        <div class="login-box">

            {{-- LOGO --}}
            <div class="login-logo">
                <div class="logo-icon">
                    <i class="bi bi-flower2"></i>
                </div>

                <h1>Cosmetiq</h1>
                <span>Sistema de Gestão para Revendedoras</span>
            </div>

            {{-- FORM --}}
            <form action="/login" method="POST" class="login-form">

                @csrf

                <div class="input-group-custom">

                    <label>E-mail</label>

                    <div class="input-field">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" placeholder="Digite seu e-mail">
                    </div>

                </div>

                <div class="input-group-custom">

                    <label>Senha</label>

                    <div class="input-field">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" placeholder="••••••••">
                    </div>

                </div>

                <button class="btn-login-cosmetiq" type="submit">

                    <i class="bi bi-box-arrow-in-right"></i>
                    Entrar

                </button>


            </form>

            <div class="login-footer">
                <i class="bi bi-shield-check"></i>
                Acesso protegido e seguro
            </div>

        </div>

    </div>

</body>

</html>