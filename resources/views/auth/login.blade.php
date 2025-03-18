<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container-fluid h-100">
        @if (session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="row h-100">
            <div class="col-md-6 p-5">
                <h2 class="mb-3 p-5 mt-5 fonteBold fs-1">Login</h2>
                <form method="POST" action="{{ route('login') }}" class="p-5">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="fontePrincipal">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@cesae.pt" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="fontePrincipal">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="senha"
                            required>
                        <small class="form-text text-muted">A senha deve ser uma combinação de no mínimo
                            8 letras,
                            números e símbolos.</small>
                    </div>
                    <div class="form-check d-flex mb-3 mt-2">
                        <div class="w-100">
                            <a href="{{ route('password.request') }}" class="float-right fonteLink">Esqueceu sua
                                senha?</a>
                        </div>
                    </div>
                    <button class="botaoLogin rounded-pill px-3 fontePrincipal" type="submit">Entrar</button>
                </form>
                <p class="mt-4 text-center fontePrincipal">Não possui registo?
                    <a href="{{ route('users.add') }}" class="fonteLink">Registe-se aqui</a>
                </p>
            </div>
            <div class="col-md-6 imagem-background">
            </div>
        </div>
    </div>
</body>

</html>
