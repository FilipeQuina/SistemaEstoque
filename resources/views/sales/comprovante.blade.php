@extends('layouts.app')
@section('content')

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
@endsection
