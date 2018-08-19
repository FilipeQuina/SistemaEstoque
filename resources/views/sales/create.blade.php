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

                    <div class="col-md-6">
                        <div class="form-group">
                            <form action="{{url('/product/show')}}" method="post">
                                {{ csrf_field() }}
                                <label for="name">Nome:</label>
                                <input type="text" name="namePesquisa" id="namePesquisa" class="form-control" required >
                                <button class="btn btn-default"> Limpar </button>
                            </form>
                            @isset ($products)

                           
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" value={{$products->name}} required >

                            <label for="id">Código de barras:</label>
                            <input type="number" name="id" id="id" class="form-control" value={{$products->id}} >

                            <label for="quantity">Quantidade:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"  required>

                            <label for="price">Preço Unitário:</label>
                            <input type="number" name="price" id="price" class="form-control" value={{$products->price}} required>
                            @endisset

                            @empty($products)
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" required >

                            <label for="id">Código de barras:</label>
                            <input type="number" name="id" id="id" class="form-control" >

                            <label for="quantity">Quantidade:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"  required>

                            <label for="price">Preço Unitário:</label>
                            <input type="number" name="price" id="price" class="form-control"  required>
                        @endempty

                            
                        </div>


                        <button class="btn btn-default">
                                    Limpar
                                </button>
                        <button class="btn btn-default" onclick="addlista()">
                                        criar
                            </button>

                    </div>
                </div>
                </form>

                <table class="table">
                    <thead>
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
                                Quantidade
                            </th>
                            <th>
                                Valor Total do Item
                            </th>
                            <th>
                                Ações
                            </th>

                        </tr>
                    </thead>
                    <tbody id="item">


                    </tbody>


                    <td>
                        <a href="#" class="btn btn-danger">Apagar</a>

                    </td>

                </table>


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
                var itens={id:id,name:name,qtd:qtd}; 
    
                tr.appendChild(tdId);
                tr.appendChild(tdName);
                tr.appendChild(tdPrice);
                tr.appendChild(tdQtd);
                tr.appendChild(tdVTotalItem);

                document.getElementById("item").appendChild(tr);
                listaDeItens.push(itens);
    
                console.log(listaDeItens);
            }
            function teste(){
                window.alert("alodad");
            }

</script>
@endsection