@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <h2 class="text-center">Cadastrar Administrador</h2>
                <hr />
                <form method="post" action="/adm/{{$user->id}}">
                    @csrf
                    @method('put')
                    <input class="form-control" type="text" name="codpes" value="{{old ('codpes', $user->codpes)}}" placeholder="Insira o N. USP do Usuário">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja cadastrar este user como ADM?');">Cadastrar como administrador</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .btn-success{
        margin-top:20px;
        padding:15px;
        width:100%;
    }
</style>