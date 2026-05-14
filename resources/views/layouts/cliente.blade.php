<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Cosmetiq') }}</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Lora:wght@400;500;600&display=swap"
        rel="stylesheet">

    {{-- CSS Global --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- CSS específico de cada página --}}
    @stack('styles')

    <style>
        /* Layout para cliente - sem sidebar */
        .cliente-layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* TOPBAR cliente */
        .cliente-topbar {
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 18px rgba(156, 74, 48, 0.15);
        }

        .cliente-topbar-left {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .cliente-logo {
            font-family: 'Lora', serif;
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cliente-logo i {
            font-size: 28px;
        }

        .cliente-user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cliente-user-info i {
            font-size: 28px;
        }

        .cliente-topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cliente-logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cliente-logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        /* CONTEÚDO cliente */
        .cliente-content {
            flex: 1;
            padding: 40px;
            background: #faf4ee;
        }

        .cliente-content-header {
            margin-bottom: 35px;
        }

        .cliente-content-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cliente-content-header p {
            color: #8a7060;
            margin-top: 8px;
            font-size: 15px;
        }

        /* ALERTAS */
        .cliente-alert {
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 20px;
            border: none;
        }

        .cliente-alert-success {
            background: #f0faf5;
            color: #1a7a4a;
            border-left: 4px solid #1a7a4a;
        }

        .cliente-alert-danger {
            background: #fff0f0;
            color: #c93a3a;
            border-left: 4px solid #c93a3a;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .cliente-topbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .cliente-topbar-left {
                flex-direction: column;
                width: 100%;
            }

            .cliente-topbar-right {
                width: 100%;
                justify-content: center;
            }

            .cliente-content {
                padding: 20px;
            }

            .cliente-content-header h1 {
                font-size: 24px;
            }
        }
    </style>

</head>

<body>

    <div class="cliente-layout">

        {{-- TOPBAR --}}
        <header class="cliente-topbar">

            <div class="cliente-topbar-left">
                <div class="cliente-logo">
                    <i class="bi bi-flower1"></i>
                    Cosmetiq
                </div>
                <div class="cliente-user-info">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>

            <div class="cliente-topbar-right">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="cliente-logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Sair
                    </button>
                </form>
            </div>

        </header>

        {{-- CONTEÚDO --}}
        <main class="cliente-content">

            {{-- HEADER --}}
            <div class="cliente-content-header">
                <h1>
                    @stack('header-icon')
                    @yield('title', 'Minha Área')
                </h1>
                @stack('header-subtitle')
            </div>

            {{-- ALERTAS --}}
            @if(session('success'))
                <div class="cliente-alert cliente-alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('erro'))
                <div class="cliente-alert cliente-alert-danger">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('erro') }}
                </div>
            @endif

            {{-- CONTEÚDO DAS PÁGINAS --}}
            @yield('content')

        </main>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- JS Global --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- JS específico de cada página --}}
    @stack('scripts')


</body>

</html>
