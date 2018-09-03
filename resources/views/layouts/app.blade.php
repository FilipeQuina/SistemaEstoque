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
   <script src="{{ asset('js/manipula-lista.js') }}"></script>
    <script>
        
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