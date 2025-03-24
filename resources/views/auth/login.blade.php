<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container-fluid h-100">

        <div class="row h-100">
            <div class="col-md-6 p-5">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h2 class="p-5 mt-2 fonteBold fs-1">Login</h2>
                <form method="POST" action="{{ route('login') }}" class="p-5">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="fontePrincipal">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@msft.cesae.pt" required pattern="^[a-zA-Z0-9._%+-]+@msft\.cesae\.pt$"
                            title="O email deve terminar com @msft.cesae.pt">
                        @error('email')
                            <small class="text-danger">Seu e-mail parece estar incorreto. Tente novamente!</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="fontePrincipal">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha"
                            required>
                        <small class="form-text text-muted">A senha deve ser uma combinação de no mínimo 8 caracteres,
                            contendo letras,
                            números e símbolos.</small>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check d-flex mb-3 mt-2">
                        <div class="w-100">
                            <a href="{{ route('password.request') }}" class="float-right fonteLink">Esqueceu sua
                                senha?</a>
                        </div>
                    </div>
                    <button class="botaoLogin rounded-pill px-3 fontePrincipal" type="submit">Entrar</button>
                </form>
                <p class="text-center fontePrincipal">Não possui registo?
                    <a href="{{ route('users.add') }}" class="fonteLink">Registe-se aqui</a>
                </p>
            </div>
            <div class="col-md-6 imagem-background">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/validacoes.js') }}"></script>

</body>

</html>
