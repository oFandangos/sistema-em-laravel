@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
            <b>Users</b><br /><hr />
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
                <h3 class="text-center">Área admnistrativa</h3>
            </div>
            <div class="card-body" style="margin-top:15px;">
                <a href="/adm/create" class="btn btn-info">Cadastrar administrador</a>
                <a href="/adm/banir" class="btn btn-danger">Banir usuário</a>
            </div>
        </div>
    </div>  
</div>

<style>
    .btn{
        width:100%;
        margin-top:8px;
    }
</style>

@endsection