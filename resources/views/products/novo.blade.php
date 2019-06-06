@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Adicionar produtos
                </div>

                <div class="card-body">
                    <form action="/product/store" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="id">Código de barras:</label>
                                <input type="number" name="id" class="form-control" >

                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" required>

                                <label for="quantity">Quantidade:</label>
                                <input type="number" name="quantity" class="form-control" required>
                           
                                <label for="price">Preço:</label>
                                <input type="text" name="price" class="form-control" >
                            </div>

                            <div class="col-md-12">
                                <button type="reset" class="btn btn-default">
                                    Limpar
                                </button>
                                <button type="submit" class="btn btn-warning" id="black">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection