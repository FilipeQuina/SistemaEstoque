@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Produtos
                    <a  href="{{url('products/novo')}}" >Adicionar produtos</a>
                </div>

                <div class="card-body">
                    @foreach($products as $product)
                    @php
                      $date=date('Y-m-d', $product['date']);
                      @endphp
                    <tr>
                      <td>{{$product['codBar']}}</td>
                      <td>{{$product['name']}}</td>
                      <td>{{$product['price']}}</td>
                      <td>{{$product['amountStock']}}</td>
                  
                      
                      <td><a href="#"class="btn btn-warning">Edit</a></td>
                      <td>
                        <form action="#" method="post">
                          @csrf
                          <input name="_method" type="hidden" value="DELETE">
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection