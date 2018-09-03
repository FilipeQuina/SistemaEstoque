@extends('layouts.app') @section('content')

<div class="container">

    @if(session('message'))
    <div class="alert alert-success">
        <p>{{session('message')}}</p>
    </div>
    @endif

    <img src="{!! asset('img/picture.png') !!}">
    
            <table id="table-budget" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código de barras</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preco unitário</th>
                        <th>Valor total do item</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($parseJSON as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['qtd']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['VTotalItem']}}</td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Valor Total: {{$amountSale}}</td>
                    </tr>
                </tfoot>
            </table>
       
        @endsection