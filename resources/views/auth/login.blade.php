@extends('laravel-usp-theme::master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/login">
                        @csrf
                        <label for="name">Codpes</label>
                        <input type="text" name="codpes" class="form-control" value="{{old('codpes')}}">
                        <label for="password">Senha</label>
                        <input type="password" name="password" name="password" class="form-control">
                        <button type="submit" class="btn btn-success" style="margin-top:10px; width:100%; padding:10px;">Enviar</button>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="/" class="btn btn-outline-primary">Voltar</a>

@endsection