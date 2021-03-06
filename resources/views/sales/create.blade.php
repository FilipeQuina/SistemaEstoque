@extends('layouts.app') @section('content')

<div class="container">

    @if(session('message'))
    <div class="alert alert-success">
        <p>{{session('message')}}</p>
    </div>
    @endif

    <div class="row">
        <div class='col-md-4'>
            <div class="form-control espacamento">
                Pesquise o Produto:
                <div class="input-group input-group-sm">
                    <div class="ui-widget">
                       
                        <input id="namePesquisa">
                      </div>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" id="buscaProduto_btn"> Buscar </button>
                    </span>
                </div>
            </div>
            <div class="form-control">
                <form action="/sales/create" method="post" name="formularioVenda" id="formularioVenda">
                    {{ csrf_field() }}
                    <label for="orcamento">Orçamento?:</label>
                    <input type="checkbox" name="orcamento" id="orcamento" >
                    <input type="hidden" name="itensLista" id="itensLista">
                    <input type="hidden" name="valorTotal" id="valorTotal">

                </form>

                <div>
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" readonly>
                </div>
                <div>
                    <label for="id">Código de barras:</label>
                    <input type="number" name="id" id="id" class="form-control" readonly>
                </div>
                <div>
                    <label for="price">Preço Unitário:</label>
                    <input type="number" name="price" id="price" class="form-control" readonly>
                </div>
                <div>
                    <label for="quantity">Quantidade:</label>
                    <input type="number" name="quantity" id="quantity" min="0" step=".01" class="form-control">
                </div>
                <div>
                    <label for="amntStock">Estoque:</label>
                    <input type="number" name="amntStock" id="amntStock" class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-control ">
                <div class="espacamento">
                    <button class="btn btn-warning" onclick="addlista()"> Adicionar Produtos </button>
                    <button class="btn btn-success float-right" id="fecharVenda"> Fechar venda </button>
                </div>
                <div class="limite-tabela">

                    <table class="table table-bordered table-condensed " id="tabelaDeItens">
                        <thead>
                            <tr>
                                <th>Código de barras</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Valor Total</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="item"></tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <label for="valorTotal_input">valor Total:</label>
                <input type="number" name="valorTotal_input" id="valorTotal_input" class="form-control" readonly>
            </div>
        </div>
       
    </div>
</div>
<script src="{{ asset('js/manipula-lista.js') }}"></script>
@endsection