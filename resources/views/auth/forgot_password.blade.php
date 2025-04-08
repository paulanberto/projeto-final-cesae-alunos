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
        <div class="background-purple"></div>

        <div class="password-reset-card">

            <div class="form-header">
                <img src="{{ asset('imagens/logoCorrido.png') }}" alt="Logo" class="logo">
                <h2 class="fonteBold">Recuperar a sua senha</h2>
            </div>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Email para redefinição enviado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="fontePrincipal">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="email@msft.cesae.pt" required pattern="^[a-zA-Z0-9._%+-]+@msft\.cesae\.pt$"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger mt-2">Já enviamos um email para redefinição</div>
                    @enderror
                    <small class="form-text text-muted mt-2">Enviaremos um link para redefinir sua senha para o email
                        registado.</small>
                </div>

                <button class="reset-button rounded-pill px-3 fontePrincipal" type="submit">
                    Enviar link de redefinição
                </button>
            </form>

            <div class="login-link">
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
