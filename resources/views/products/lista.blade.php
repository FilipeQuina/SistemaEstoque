@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session('message'))
                <div class="alert alert-success">
                    <p>{{session('message')}}</p>
                </div>
                @endif
                <div class="card-header">
                    Produtos
                    <a href="{{url('product/novo')}}" class="float-right">Adicionar produtos</a>
                </div>
                <table class="display" id="mytable">
                    <tr>
                        <th>
                            Código de barras
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            Preco
                        </th>
                        <th>
                            Quantidade em estoque
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product['id']}}</td>
                        <td>{{$product['name']}}</td>
                        <td>R$ {{str_replace(".",",",$product['price'])}}</td>
                        <td>{{$product['amountStock']}}</td>
                        <td>
                            <a href="/product/edit/{{$product['id']}}" class="btn btn-warning">Editar</a>
                            <a href="/product/destroy/{{$product['id']}}" class="btn btn-danger">Apagar</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection