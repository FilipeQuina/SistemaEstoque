<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;



class SalesController extends Controller
{
    public function index(){
        return view("sales.create");
    }
    
    public function store(Request $request)
    {
        $sale = new Sale;
        $sale->caixa2        = $request->caixa2;
        $sale->save();

        return redirect()->action('SalesController@index')->with('message', 'sale created successfully!');
    }
}
