<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
  public function toResponse($request)
  {
    // Aqui você define para onde o usuário será redirecionado após o login
    return redirect()->intended('/home'); // ou qualquer outra rota
  }
}
