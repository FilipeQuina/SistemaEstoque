@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Produtos
                    <a class="pull-right" href="{{url('pruducts/novo')}}" >Novo Produto</a>
                </div>

                <div class="card-body">
                    VocẼ está logado!!!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection