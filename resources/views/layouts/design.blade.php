@extends('layouts.fo_layout')
@section('content')

<h3>design dos botões</h3>
<div class="container">


    //botoes editados no css
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">Enviar</button>  todos os botoes de enviar</p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">Entrar</button>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">Criar nova categoria</button>  o mesmo para Criar</p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">Criar material</button></p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">ir para Forum</button>   possivel botao</p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">view users</button>  somente para o admin</p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">responder</button></p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">alterar</button></p>
    <p><button class="botaoPrincipal rounded-pill px-3" type="button">Marcar como soluçao</button></p>


    //botao com padrao boostrap vermelho
    <p><button class="btn btn-danger rounded-pill px-3" type="button">Excluir</button></p>

    //fonte usada para os textos e titulos
    <p class="fontePrincipal">texto com fonte principal</p>
    <h1 class="fontePrincipal">texto com a fonte certa</h1>

    //fonte usada para os textos e titulos em bold
    <p class="fonteBold">texto com fonte principal</p>
    <h1 class="fonteBold">texto com a fonte certa</h1>




</div>

@endsection
