@extends('layouts.app')
@section('content')

<div class="container">


    <div class="card">
        <div class="card-header">
            Adicionar produtos
        </div>

        <div class="card-body">
            <div class="form-group">
                <form action="{{url('/product/show')}}" method="post">
                    {{ csrf_field() }}

                    <label for="name">Nome:</label>
                    <input type="text" name="namePesquisa" id="namePesquisa" class="form-control">
                    <button class="btn btn-success"> Buscar </button>

                </form>
            </div>

            <div class="form-group ">
                @isset ($products)
                    <input type="hidden" name="caixa2" id="caixa2" value="1">
                    <div class=row>
                        <div class="col-md-5">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" value={{$products->name}} readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="id">Código de barras:</label>
                            <input type="number" name="id" id="id" class="form-control" value={{$products->id}} readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="quantity">Quantidade:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="price">Preço Unitário:</label>
                            <input type="number" name="price" id="price" class="form-control" value={{$products->price}}
                            readonly>
                        </div>
                    </div>

                <button class="btn btn-success " id="fecharVenda"> Fechar venda </button>
                <button class="btn btn-default" onclick="addlista()"> criar </button> @endisset

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
        var tdPrice= document.createElement("td");
        var tdQtd = document.createElement("td");
        var tdVTotalItem = document.createElement("td");


        tdId.innerHTML = id;
        tdName.innerHTML = name;
        tdPrice.innerHTML = price;
        tdQtd.innerHTML = qtd;
        tdVTotalItem.innerHTML = VTotalItem;

        var itens={id:id,qtd:qtd,price:price,VTotalItem:VTotalItem,};

        tr.appendChild(tdId);
        tr.appendChild(tdName);
        tr.appendChild(tdPrice);
        tr.appendChild(tdQtd);
        tr.appendChild(tdVTotalItem);

        document.getElementById("item").appendChild(tr);
        listaDeItens.push(itens);
        document.getElementById("listaItens").value=listaDeItens;

    }

            $(document).ready(function(){
                $("#fecharVenda").click(function(event){

                    $.ajax({
                        //url:"{{url('/sales/create')}}",
                        url:"/sales/create",
                        type:'post',
                        datatype:'json',
                        data:{ lista: listaDeItens, _token: '{{csrf_token()}}' },
                        success:function(data){

                        },
                        error:function(data){
                            console.log("erro");
                        }

                    })
                });
        });

</script>
@endsection
