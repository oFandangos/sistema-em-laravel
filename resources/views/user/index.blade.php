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

            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Usuários</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                <td>
                    {{$user->name}} - {{$user->codpes}} 
                    @if($user->is_admin == 1) - <b class="text-success">ADM</b>
                    @elseif($user->is_banned == 1) - <b class="text-danger">Banido</b>
                    @endif
                </td>
                <td>
                    <a href="/adm/create/{{$user->id}}" class="btn btn-primary"><i class="bi bi-person-fill-up"></i></a>
                    <a href="/adm/banir/{{$user->id}}" class="btn btn-danger"><i class="fa fa-hammer" style="margin:5px;"></i></a>
                </td>
                <td>
            @endforeach
            </tr>
            </tbody>            
        </table>
        </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <h3 class="text-center">Ações do Administrador</h3>
                <hr />
                    <a href="/adm/avisos" class="btn btn-info">Adicionar Avisos</a>
                    <a href="/adm/prod-listar" class="btn btn-warning">Produtos a serem aceitos</a>
                    <a href="/cat" class="btn btn-success" id="success">Ver categorias</a>
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
    .btn-info, .btn-warning, #success{
        width:100%;
        margin-top:8px;
    }

    .btn-primary{
        margin-left:5px;
    }

    form{
        padding:0 !important;
        margin:0;
    }
</style>

@endsection