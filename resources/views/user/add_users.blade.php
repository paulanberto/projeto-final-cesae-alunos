<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/registo.css') }}">
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-6 p-5">

                <h2 class="p-3 fonteBold">Registo</h2>
                <form method="POST" action="{{ route('users.create') }}" class="p-5">
                    @csrf

                    <div class="d-flex flex-row justify-content-between mb-3">
                        <div style="width: 65%">
                            <label for="curso_id" class="fontePrincipal">O seu Curso</label>
                            <select class="form-control" id="curso_id" name="curso_id" required>
                                <option value="">Selecione um curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                @endforeach
                            </select>
                            @error('curso_id')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="width: 30%">
                            <label for="ano" class="fontePrincipal">Ano</label>
                            <select class="form-control" id="ano" name="ano" required>
                                <option value="">Selecione</option>
                                @foreach ($anos as $ano)
                                    <option value="{{ $ano }}">{{ $ano }}</option>
                                @endforeach
                            </select>
                            @error('ano')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstName" class="fontePrincipal">Nome Completo</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Seu Nome"
                            required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="fontePrincipal">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@msft.cesae.pt" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="fontePrincipal">Confirme o seu Email</label>
                        <input type="email" class="form-control" id="email_confirmation" name="email_confirmation"
                            placeholder="email@msft.cesae.pt" required>
                        @error('email_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
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

                    <div class="form-group">
                        <label for="password_confirmation" class="fontePrincipal">Confirme a sua Senha</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirme a sua senha" required>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="termos" name="termos">
                        <label class="form-check-label fontePrincipal" for="termos">Aceito os termos e condições para
                            acesso a comunidade bem como o tratamento de dados pessoais e sua política de privacidade.
                            <a href="{{ route('politicas') }}" class="fonteLink">Acesso a política de privacidade e
                                regras da
                                comunidade</a></label>
                        @error('termos')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="botaoLogin rounded-pill px-3 fontePrincipal" type="submit">Registar</button>
                </form>

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
