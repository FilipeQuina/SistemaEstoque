<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        if(Auth::check()){
            return view("products.lista");
        }
       
    }
}
