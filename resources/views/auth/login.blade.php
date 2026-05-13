<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetiq | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --terra: #9c4a30;
            --terra-light: #c4693a;
            --terra-dark: #7a3420;
            --bg: #faf4ee;
            --texto: #2a1a10;
            --cinza: #8a7060;
            --borda: #ede0d4;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── FUNDO ANIMADO ───────────────────────────── */
        .bg-dots {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: radial-gradient(circle, rgba(156, 74, 48, .08) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        .bg-orbs {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: drift linear infinite;
            opacity: 0;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(196, 105, 58, .18), transparent 70%);
            top: -100px;
            left: -100px;
            animation-duration: 18s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(156, 74, 48, .13), transparent 70%);
            bottom: -80px;
            right: -80px;
            animation-duration: 22s;
            animation-delay: -8s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(232, 196, 160, .25), transparent 70%);
            top: 50%;
            left: 60%;
            animation-duration: 15s;
            animation-delay: -4s;
        }

        @keyframes drift {
            0% {
                opacity: 0;
                transform: translate(0, 0) scale(1);
            }

            10% {
                opacity: 1;
            }

            50% {
                transform: translate(30px, -30px) scale(1.08);
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translate(0, 0) scale(1);
            }
        }

        /* ── CARD ────────────────────────────────────── */
        .card-login {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 48px 44px;
            background: rgba(255, 255, 255, .85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            border: 1px solid rgba(237, 224, 212, .8);
            box-shadow:
                0 2px 4px rgba(156, 74, 48, .04),
                0 8px 24px rgba(156, 74, 48, .08),
                0 32px 64px rgba(156, 74, 48, .06);
            animation: cardIn .6s cubic-bezier(.22, 1, .36, 1) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(24px) scale(.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ── TOPO ────────────────────────────────────── */
        .login-top {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-icon-wrap {
            width: 72px;
            height: 72px;
            margin: 0 auto 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--terra), var(--terra-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
            box-shadow: 0 8px 24px rgba(156, 74, 48, .28);
            position: relative;
        }

        .login-icon-wrap::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 26px;
            border: 2px solid rgba(156, 74, 48, .2);
            animation: pulse-ring 2.5s ease infinite;
        }

        @keyframes pulse-ring {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            70% {
                opacity: 0;
                transform: scale(1.18);
            }

            100% {
                opacity: 0;
                transform: scale(1.18);
            }
        }

        .login-top h1 {
            font-family: 'Lora', serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--texto);
            letter-spacing: -.3px;
            margin-bottom: 6px;
        }

        .login-top p {
            font-size: 14px;
            color: var(--cinza);
        }

        /* ── ERRO ────────────────────────────────────── */
        .login-error {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fdeaea;
            border: 1px solid rgba(209, 90, 90, .2);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 22px;
            font-size: 13px;
            color: #c0392b;
            font-weight: 600;
            animation: shake .4s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-6px);
            }

            40% {
                transform: translateX(6px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        /* ── CAMPOS ──────────────────────────────────── */
        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #4a3020;
            margin-bottom: 8px;
        }

        .field-wrap {
            position: relative;
        }

        .field-wrap .f-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #c0a898;
            pointer-events: none;
            transition: color .2s;
        }

        .field-wrap input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border-radius: 14px;
            border: 1.5px solid var(--borda);
            background: #fdf9f6;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            color: var(--texto);
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .field-wrap input::placeholder {
            color: #d0b8a8;
        }

        .field-wrap input:focus {
            outline: none;
            border-color: var(--terra);
            background: white;
            box-shadow: 0 0 0 4px rgba(156, 74, 48, .1);
        }

        .field-wrap:has(input:focus) .f-icon {
            color: var(--terra);
        }

        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #c0a898;
            font-size: 16px;
            padding: 4px;
            transition: color .2s;
        }

        .toggle-pw:hover {
            color: var(--terra);
        }

        .field-wrap.has-toggle input {
            padding-right: 44px;
        }

        /* ── BOTÃO ───────────────────────────────────── */
        .btn-entrar {
            width: 100%;
            margin-top: 8px;
            padding: 15px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, var(--terra-dark), var(--terra), var(--terra-light));
            background-size: 200% 200%;
            background-position: left center;
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background-position .4s ease, transform .2s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(156, 74, 48, .28);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-entrar:hover {
            background-position: right center;
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(156, 74, 48, .32);
        }

        .btn-entrar:active {
            transform: translateY(0);
        }

        .btn-entrar.loading {
            pointer-events: none;
            opacity: .8;
        }

        .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(255, 255, 255, .3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-entrar.loading .spinner {
            display: block;
        }

        .btn-entrar.loading .btn-icon,
        .btn-entrar.loading .btn-text {
            display: none;
        }

        /* ── RODAPÉ ──────────────────────────────────── */
        .login-footer {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #f0e4d8;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 12px;
            color: #b09080;
            font-weight: 500;
        }

        .login-footer i {
            color: var(--terra);
        }

        @media (max-width: 480px) {
            .card-login {
                padding: 36px 28px;
                margin: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="bg-dots"></div>
    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="card-login">

        <div class="login-top">
            <div class="login-icon-wrap">
                <i class="bi bi-flower2"></i>
            </div>
            <h1>Cosmetiq</h1>
            <p>Entre para acessar o sistema</p>
        </div>

        @if($errors->any())
            <div class="login-error">
                <i class="bi bi-exclamation-circle-fill"></i>
                E-mail ou senha incorretos. Tente novamente.
            </div>
        @endif

        <form action="/login" method="POST" id="login-form">
            @csrf

            <div class="field">
                <label for="email">E-mail</label>
                <div class="field-wrap">
                    <i class="bi bi-envelope f-icon"></i>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" value="{{ old('email') }}"
                        required autofocus>
                </div>
            </div>

            <div class="field">
                <label for="password">Senha</label>
                <div class="field-wrap has-toggle">
                    <i class="bi bi-lock f-icon"></i>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    <button type="button" class="toggle-pw" id="toggle-pw" tabindex="-1" aria-label="Mostrar senha">
                        <i class="bi bi-eye" id="toggle-icon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-entrar" id="btn-entrar">
                <i class="bi bi-box-arrow-in-right btn-icon"></i>
                <span class="btn-text">Entrar</span>
                <div class="spinner"></div>
            </button>

        </form>

        <div class="login-footer">
            <i class="bi bi-shield-check"></i>
            Acesso protegido e seguro
        </div>

    </div>

    <script>
        // Toggle senha
        const toggleBtn = document.getElementById('toggle-pw');
        const toggleIcon = document.getElementById('toggle-icon');
        const pwInput = document.getElementById('password');

        toggleBtn.addEventListener('click', () => {
            const visivel = pwInput.type === 'text';
            pwInput.type = visivel ? 'password' : 'text';
            toggleIcon.className = visivel ? 'bi bi-eye' : 'bi bi-eye-slash';
        });

        // Spinner no botão ao submeter
        document.getElementById('login-form').addEventListener('submit', () => {
            document.getElementById('btn-entrar').classList.add('loading');
        });
    </script>

</body>

</html>