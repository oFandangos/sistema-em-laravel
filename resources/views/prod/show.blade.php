@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Informações sobre o produto</h2>
                    <hr/> 
                    <p>Nome: {{$produto->nome_prod}}</p>
                    <div class="row" style="margin-left:1px;">
                        <p style="margin-right:3px;">Valor R$:</p> 
                        <p class="num">{{$produto->valor_prod}}</p>
                    </div>

                    <p>Categoria: {{$produto->category->nome_cat}}</p>
                    
                    <p>Autor: <a href="#">{{$user->email ?? 'N/A'}}</a></p>
                    
                    @if(isset($autor) && ($autor->id == $produto->user_id))
                    @include('files.partials.form')
                    <a href="/produto/edit/{{$produto->id}}" class="btn btn-warning" style="width:100%; margin-top:8px;"><i class="bi bi-pencil-square"></i>Editar Produto</a>
                    <form method="post" action="/produto/{{$produto->id}}">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');" style="width:100%; margin-top:8px;"><i class="bi bi-trash-fill"> Excluir</i></button>
                    </form> 
                    @else
                    @endif
                    <a class="btn btn-success"><i class="bi bi-cart-plus-fill"></i>Comprar produto</a>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($produto->files as $file)
<img style="width:100px;" src="/files/{{$file->id}}">
@endforeach

<script>
        // Função para formatar número com pontos como separadores de milhar
        function formatNumber(num) {
        // Separar parte inteira e decimal
        let parts = parseInt(num).toFixed(2).split('.');
        // Adicionar pontos como separadores de milhar
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        // Juntar parte inteira e decimal com vírgula
        return parts.join();
    }
    // Selecionar todas as células de preço e formatar os números
    document.querySelectorAll('.num').forEach(function(element) {
        let formattedNumber = formatNumber(element.textContent);
        element.textContent = formattedNumber;
    });
</script>

@endsection