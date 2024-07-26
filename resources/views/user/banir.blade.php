@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <h2 class="text-center">Banir usuário</h2>
                <hr />
                <form method="post" action="/adm/banido/">
                    @csrf
                    @method('put')
                    <input class="form-control" type="text" name="codpes" value="{{old ('codpes', $user->codpes)}}" placeholder="Insira o N. USP do Usuário">
                    <textarea id="txt" class="form-control" placeholder="Insira o motivo" name="justificativa" required></textarea>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja BANIR este user?');">Banir usuário</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .btn-danger{
        margin-top:20px;
        padding:15px;
        width:100%;
    }
    #txt{
        margin-top:10px;
        margin-bottom:10px;
    }
</style>