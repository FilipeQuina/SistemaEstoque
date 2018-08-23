<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sales_Products;


class SalesController extends Controller
{
    public function index(){
        return view("sales.create");
    }
    
    public function store(Request $request)
    {
        
        if($request->ajax()){
            $sale = new Sale;
            $sale->caixa2 = false;
            $sale->save();

            for($i=0;$i<count($request->lista);$i++){
               
                $sales_prod = new Sales_Products;
                $sales_prod->products_id = $request->lista[$i]['id'];
                $sales_prod->sales_id = $sale->id;
                $sales_prod->quantity = 3;
                $sales_prod->amountItem = 3;
                $sales_prod->save();
            }

        }
        else{
            echo("não veio o request");
        }

        return view("sales.create",[
            'req'=>json_encode($request->lista)
        ]);
    }
}
