@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <h3 class="text-center">Área admnistrativa</h3>
            </div>
        </div>
    </div>

        <!-- <div class="row">
            <div class="col-md-4" style="margin-top:15px;">
                <form method="get" action="/user">
                    <input type="text" id="search" name="search" value="{{request()->search}}" class="form-control" placeholder="Procurar por usuário">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Procurar</button>
                </form>
            </div>
        </div> -->
        
<div class="row">
    <div class="col-md-8">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <b>Total de usuários:</b> {{$usersCount}}
                </div>
                <div class="col-8">
                    <form method="get" action="/user">
                        <input type="text" id="search" name="search" value="{{request()->search}}" class="form-control" placeholder="Procurar por usuário">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Procurar</button>
                    </form>
                </div>
            </div>
            <hr />
            @forelse($users as $user)
                {{$user->name}} -
                {{$user->codpes}}
            @if($user->is_admin == 1) - <b class="text-success">ADM</b>
            @elseif($user->is_banned == 1) - <b class="text-danger">BANIDO</b>
            @endif
                <br />
            @empty
                Não foram encontrados usuários
            @endforelse
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <h3 class="text-center">Ações do Administrador</h3>
                <hr />
                    <a href="/adm/create" class="btn btn-info">Cadastrar/Remover Administrador</a>
                    <a href="/adm/banir" class="btn btn-danger">Banir/Desbanir um usuário</a>
                </div>
            </div>
        </div>  
    </div>
</div>

<style>

    .col-md-8, .col-md-4{
        margin-top:15px;
    }
    .form-control{
        margin-top:5px;
        display:initial !important;
        padding:1.3rem;
        width:70%;
    }
    .btn-info, .btn-danger{
        width:100%;
        margin-top:8px;
    }

    form{
        padding:0 !important;
        margin:0;
    }
</style>

@endsection