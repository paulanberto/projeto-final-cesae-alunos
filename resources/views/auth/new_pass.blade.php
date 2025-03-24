<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie uma nova senha</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/new_pass.css') }}">
</head>
<body>
    <div class="password-reset-container">
        <div class="background-purple"></div>
        
        <div class="password-reset-card">
            <div class="form-header">
                <h2 class="fonteBold">Crie uma nova senha</h2>
            </div>
            
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <!-- Token de redefinição de senha -->
                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                
                <div class="form-group">
                    <label for="email" class="fontePrincipal">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ $email ?? request()->email ?? old('email') }}" required readonly>
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="fontePrincipal">Nova senha</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Nova senha" required>
                    <small class="form-text text-muted mt-2">A senha deve ser uma combinação de no mínimo 8 caracteres,
                        contendo letras, números e símbolos.</small>
                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="fontePrincipal">Confirme a nova senha</label>
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" placeholder="Confirme a nova senha" required>
                    @error('password_confirmation')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <button class="reset-button rounded-pill px-3 fontePrincipal" type="submit">
                    Redefinir senha
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