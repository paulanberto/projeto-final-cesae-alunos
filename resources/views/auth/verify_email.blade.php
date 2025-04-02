<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código Aberto</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forgot_password.css') }}">
</head>

<body>
    <div class="password-reset-container">
        <div class="password-reset-card" style="max-width: 600px; width: 90%;">
            <div class="form-header">
                <img src="{{ asset('imagens/logoCorrido.png') }}" alt="Logo" class="logo">
                <h2 class="fonteBold">Verificação de E-mail</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <p class="fontePrincipal">
                <strong>Obrigado pelo seu registro!</strong>
            </p>

            <p class="fontePrincipal">
                Acabamos de enviar um e-mail para
                <strong>{{ session('register_email') ?? 'seu endereço de e-mail' }}</strong>
                com um link de verificação.
                Por favor, verifique sua caixa de entrada (e pasta de spam) e clique no link para confirmar
                sua conta.
            </p>

            <p class="fontePrincipal">
                Se você não recebeu o e-mail, clique no botão abaixo para solicitar um novo link:
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('register_email') }}">
                <button type="submit" class="reset-button rounded-pill px-3 fontePrincipal">
                    Reenviar e-mail de verificação
                </button>
            </form>

            <div class="login-link mt-3">
                <a href="{{ route('login') }}" class="fontePrincipal">Voltar para o login</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/validacoes.js') }}"></script>
</body>

</html>
