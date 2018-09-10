@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar produto
                </div>

                <div class="card-body">
                    <form action="/product/update/{{$product['id']}}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">
                                
                                <label for="id">Código de barras:</label>
                                <input type="number" name="id" class="form-control" value="{{$product['id']}}">

                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" required value="{{$product['name']}}">

                                <label for="quantity">Quantidade:</label>
                                <input type="number" name="quantity" class="form-control" required value="{{$product['amountStock']}}">

                                <label for="quantity">Quantidade Adicionada:</label>
                                <input type="number" name="quantityPlus" class="form-control"  value=0>

                                <label for="price">Preço:</label>
                                <input type="text" name="price" class="form-control" value="{{$product['price']}}">
                            </div>

                            <div class="col-md-12">
                                
                                <button type="submit" class="btn btn-warning" id="black">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection