@extends('layouts.app') @section('content')

<div class="container">

    @if(session('message'))
    <div class="alert alert-success">
        <p>{{session('message')}}</p>
    </div>
    @endif

    <div class="row">
        <div class='col-md-4'>
            <div class="form-control" style="margin-bottom: 10px">
                Pesquise o Produto:
                <div class="input-group input-group-sm">
                    <input type="text" name="namePesquisa" id="namePesquisa">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" id="buscaProduto_btn"> Buscar </button>
                    </span>
                </div>
            </div>
            <div class="form-control">
                <form action="/sales/create" method="post" name="formularioVenda" id="formularioVenda">
                    {{ csrf_field() }}
                    <label for="orcamento">Orçamento?:</label>
                    <input type="hidden" name="orcamento" id="orcamento" value="1">
                    <input type="hidden" name="itensLista" id="itensLista">

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
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" required>
                    </div>


                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-control">


                <div style="margin-bottom: 10px">
                    <button class="btn btn-warning" onclick="addlista()"> Adicionar Produtos </button>
                    <button class="btn btn-success float-right" id="fecharVenda"> Fechar venda </button>
                </div>

                <!--<div><a href="javascript:document.form.submit();">CADASTRAR</a>.</div>-->
                <table class="table table-sm table-bordered" id="tabelaDeItens">
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
    </div>
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
        if (name != "") {



            var tr = document.createElement("tr");
            var tdId = document.createElement("td");
            var tdName = document.createElement("td");
            var tdPrice = document.createElement("td");
            var tdQtd = document.createElement("td");
            var tdVTotalItem = document.createElement("td");
            var tdAcao = document.createElement("td");

            tdId.innerHTML = id;
            tdName.innerHTML = name;
            tdPrice.innerHTML = price;
            tdQtd.innerHTML = qtd;
            tdVTotalItem.innerHTML = VTotalItem;
            tdAcao.innerHTML = '<input type="button" class="btn btn-danger" value="Excluir" onclick="deleteRow(this.parentNode.parentNode.rowIndex)">';

            var itens = { id: id, qtd: qtd, price: price, VTotalItem: VTotalItem, };

            tr.appendChild(tdId);
            tr.appendChild(tdName);
            tr.appendChild(tdPrice);
            tr.appendChild(tdQtd);
            tr.appendChild(tdVTotalItem);
            tr.appendChild(tdAcao);

            document.getElementById("item").appendChild(tr);
            listaDeItens.push(itens);
            
            document.getElementById("id").value = '';
            document.getElementById("name").value = '';
            document.getElementById("price").value = '';
        }

    }
    function deleteRow(i) {
        document.getElementById('tabelaDeItens').deleteRow(i);
        listaDeItens.splice(i-1,1);
        console.log(i);
        console.log(listaDeItens);
    }
    $(document).ready(function () {
        $("#fecharVenda").click(function () {
            $("#itensLista").val(JSON.stringify(listaDeItens));
            $("#formularioVenda").submit();
        });

        $("#buscaProduto_btn").click(function (event) {
            $.ajax({
                url: "/product/show",
                type: 'post',
                datatype: 'text',
                data: { nome: $('#namePesquisa').val(), _token: '{{csrf_token()}}' },
                success: function (data) {
                    $("#namePesquisa").val("");
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