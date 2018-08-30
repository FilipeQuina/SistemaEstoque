<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="{{ asset('css/personalizado.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema de Estoque
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>


                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/products') }}">{{ __('Produtos') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/sales') }}">{{ __('Vendas') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <!-- Removi a app.js-->

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script>
        var listaDeItens = [];
        var totalDaVenda = 0;
        var availableTags = [];
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
                tdAcao.innerHTML = '<input type="button" class="btn btn-danger btn-sm" value="Excluir" onclick="deleteRow(this.parentNode.parentNode.rowIndex)">';

                var itens = { id: id, qtd: qtd, price: price, VTotalItem: VTotalItem, };
                var valorAtual = totalDaVenda += VTotalItem;
                document.getElementById("valorTotal").value = valorAtual;
                document.getElementById("valorTotal_input").value = valorAtual;

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
            var valorAtual = totalDaVenda -= listaDeItens[i - 1]['price'];
            document.getElementById("valorTotal").value = valorAtual;
            document.getElementById("valorTotal_input").value = valorAtual;
            listaDeItens.splice(i - 1, 1);

            console.log(totalDaVenda);
            console.log(listaDeItens);
        }
        $(document).ready(function () {
            $("#namePesquisa").autocomplete({
                source: availableTags
            });
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
            $.ajax({
                url: "/product/listaNomes",
                type: 'get',

                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        availableTags.push(data[i].name);
                    }
                },
                error: function (data) {
                    console.log("erro");
                }
            })
        });

    </script>

</body>

</html>