@extends('layouts.app') @section('content')

<div class="container">

    @if(session('message'))
    <div class="alert alert-success">
        <p>{{session('message')}}</p>
    </div>
    @endif


    <div class="card">
        <div class="card-header">
            Adicionar produtos
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="namePesquisa" id="namePesquisa" class="form-control">
                <button class="btn btn-success" id="buscaProduto_btn"> Buscar </button>
            </div>

            <div class="form-group ">
                <form action="/sales/create" method="post">
                    {{ csrf_field() }}
                    <label for="orcamento">Orçamento?:</label>
                    <input type="checkbox" name="orcamento" id="orcamento">
                    <input type="hidden" name="itensLista" id="itensLista">
                    <div class=row>
                        <div class="col-md-5">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="id">Código de barras:</label>
                            <input type="number" name="id" id="id" class="form-control" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="quantity">Quantidade:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="price">Preço Unitário:</label>
                            <input type="number" name="price" id="price" class="form-control" readonly>
                        </div>
                    </div>

                    <button class="btn btn-success " id="fecharVenda"> Fechar venda </button>
                </form>
                <button class="btn btn-default" onclick="addlista()"> criar </button>

            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Código de barras</th>
                    <th>Nome</th>
                    <th>Preco</th>
                    <th>Quantidade</th>
                    <th>Valor Total do Item</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="item"></tbody>
        </table>
    </div>
</div>
<script>
    var listaDeItens = [];
    function addlista() {
        var id = document.getElementById("id").value;
        var name = document.getElementById("name").value;
        var price = document.getElementById("price").value;
        var qtd = document.getElementById("quantity").value;
        var VTotalItem = price * qtd;


        var tr = document.createElement("tr");
        var tdId = document.createElement("td");
        var tdName = document.createElement("td");
        var tdPrice = document.createElement("td");
        var tdQtd = document.createElement("td");
        var tdVTotalItem = document.createElement("td");


        tdId.innerHTML = id;
        tdName.innerHTML = name;
        tdPrice.innerHTML = price;
        tdQtd.innerHTML = qtd;
        tdVTotalItem.innerHTML = VTotalItem;

        var itens = { id: id, qtd: qtd, price: price, VTotalItem: VTotalItem, };

        tr.appendChild(tdId);
        tr.appendChild(tdName);
        tr.appendChild(tdPrice);
        tr.appendChild(tdQtd);
        tr.appendChild(tdVTotalItem);

        document.getElementById("item").appendChild(tr);
        listaDeItens.push(itens);
        document.getElementById("itensLista").value = JSON.stringify(listaDeItens);
        console.log(document.getElementById("itensLista").value);

    }
    $(document).ready(function () {


        $("#buscaProduto_btn").click(function (event) {
            $.ajax({
                url: "/product/show",
                type: 'post',
                datatype: 'text',
                data: { nome: $('#namePesquisa').val(), _token: '{{csrf_token()}}' },
                success: function (data) {
                    $("#name").val(data.name);
                    $("#id").val(data.id);
                    $("#price").val(data.price);
                },
                error: function (data) {
                    console.log("erro");
                }
            })
        });
    });

</script> @endsection