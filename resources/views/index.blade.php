@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<!-- @if($userAll != '')
  <a href="/produto/create" class="btn btn-success"><i class="fa fa-edit"></i> Cadastrar produto</a>
  <a href="/cat" class="btn btn-primary"><i class="fa fa-eye"></i> Ver categorias</a>
@else

@endif -->

<div class="container-fluid">
    <h4>Procurar por produto</h4>
  <form action="/" method="get">
    <div class="row">
      <div class="col-2 input-group">
        <input type="text" name="search" value="{{request()->search}}" class="form-control"  placeholder="Insira o nome do produto">
      </div>
      <div class="col-2 input-group">
        <select name="nomecategoria" class="form-control" style="margin-left:-30px;">
          <option value="" name="">- Selecione a Categoria -</option>
          @foreach($categories::categories() as $category)
          <option value="{{$category->nome_cat}}" name="nomecategoria"
            @if($category->nome_cat == Request()->nomecategoria) selected @endif
            >{{$category['nome_cat']}}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-4">
        <button class="btn btn-success" type="submit" style="margin-left:-20px;">Pesquisar</button>
      </div>
    </div>
  </form>
</div>
<hr />


<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
        @forelse($produtos as $produto)
        <b>Nome do produto:</b> {{$produto->nome_prod}}</p>
        <div class="row" style="margin:1px;">
            <b style="margin-right:3px;">Valor: </b> R$
            <p class="num"> {{$produto->valor_prod}} </p>
            </div>
        <b>Autor:</b> {{$produto->name}} </p>
        <b>Categoria:</b> {{$produto->category->nome_cat}}</p>
        <a href="/produto/show/{{$produto->id}}" class="btn btn-outline-primary" style="width:100%;"><i class="fa fa-eye"></i> Visualizar Produto</a>
        <hr />

        @empty
        <p class="text-center text-danger">Não foram encontrados produtos</p>

        @endforelse
        </div>
      </div>
    </div>

    <!-- <div class="col-md-4">
        <h3 class="text-center">Avisos</h3>
        @foreach($avisos as $aviso)
          <div class="card" style="margin-bottom:10px; border:1px solid rgb(0, 0, 0, 0.1) !important;">
            <div class="card-header">
              <b>{{$aviso->titulo}}</b>
            </div>
            <div class="card-body">
              <p>{{$aviso->texto}}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div> -->

<div class="col-md-4">
  <div class="card-body" style="padding:0;">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center">Avisos</th>
        </tr>
      </thead>
      <tbody>
        @foreach($avisos as $aviso)
        <tr>
          <td>
            <b>{{$aviso->titulo}}</b>
            <p>{{$aviso->texto}}</p>
            </td>
          @endforeach
        </tr>
      </tbody>
    </table>
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