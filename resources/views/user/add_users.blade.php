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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-5">
                <h2 class="p-5 fonteBold fs-1">Registo</h2>
                <form method="POST" action="{{ route('users.create') }}" class="p-5">
                    @csrf


                    <div class="form-group">
                        <label for="course" class="fontePrincipal">Seu Curso</label>
                        <input type="text" class="form-control" id="course" name="course"
                            placeholder="Software Developer" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName" class="fontePrincipal">Primeiro Nome</label>
                            <input type="text" class="form-control" id="firstName" name="firstName"
                                placeholder="Primeiro Nome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName" class="fontePrincipal">Apelido</label>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                placeholder="Apelido" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="email" class="fontePrincipal">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@cesae.pt" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="fontePrincipal">Confirme seu Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@cesae.pt" required>
                    </div>


                    <div class="form-group">
                        <label for="password" class="fontePrincipal">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="senha"
                            required>
                        <small class="form-text text-muted">A senha deve ser uma combinação de no mínimo
                            8 letras, números e símbolos.</small>
                    </div>

                    <div class="form-group">
                        <label for="password" class="fontePrincipal">Confirme sua Senha</label>
                        <input type="password_confirmation" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="confirme sua senha" required>

                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="termos" name="termos">
                        <label class="form-check-label fontePrincipal" for="termos">Aceito os termos e condições para
                            acesso a comunidade bem como o tratamento de dados pessoais e sua política de privacidade.
                            <a href="{{ route('home') }}" class="fonteLink">Acesso a política de privacidade e regras da
                                comunidade</a></label>
                    </div>

                    <button class="botaoLogin rounded-pill px-3 fontePrincipal" type="button">Registar</button>
                </form>

            </div>
            <div class="col-md-6 imagem-background">
            </div>
        </div>
    </div>
</body>

</html>
