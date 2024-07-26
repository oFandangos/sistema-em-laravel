@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

@if($userAll != '')
  <a href="/produto/create" class="btn btn-success"><i class="fa fa-edit"></i> Cadastrar produto</a>
  <a href="/cat" class="btn btn-primary"><i class="fa fa-eye"></i> Ver categorias</a>
@else

@endif
<p>Contagem de produtos: {{$prodCount}}</p>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-body">
      @forelse($produtos as $produto)
      <p>Nome: {{$produto->nome_prod}}</p>
      <div class="row" style="margin:1px;">
          <p style="margin-right:3px;">Valor: R$</p>
          <p class="num"> {{$produto->valor_prod}} </p>
          </div>
      <p>Autor: {{$produto->name}} </p>
      <p>Categoria: {{$produto->category->nome_cat}}</p>
      <a href="/produto/show/{{$produto->id}}" class="btn btn-outline-primary" style="width:100%;"><i class="fa fa-eye"></i> Visualizar Produto</a>
      <hr />

      @empty
      <p class="text-center text-danger">Não há produtos</p>

      @endforelse
      </div>
    </div>
  </div>
</div>
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