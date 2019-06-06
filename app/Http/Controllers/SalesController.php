<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sales_Products;
use App\Models\Product;


class SalesController extends Controller
{
    public function index(){
        return view("sales.create");
    }
     public function comprovante(){
        return view("sales.comprovante");
    }

    public function store(Request $request)
    {
        $amountSale = $request->valorTotal;
        $parseJSON=json_decode($request->itensLista,true);
        $sale = new Sale;
        if(isset($request->orcamento)){
            $isOrcamento = 1;
        }
        else{
            $isOrcamento = 0;
        }
        $sale->orcamento = $isOrcamento;
        $sale->totalValueSale = $request->valorTotal;
        $sale->save();

            for($i=0;$i<count($parseJSON);$i++){
                //Remover o estoque
                $product = Product::findOrFail($parseJSON[$i]['id']);
                $product->amountStock = $product->amountStock - $parseJSON[$i]['qtd'];
                $product->save();

                $sales_prod = new Sales_Products;
                $sales_prod->products_id = $parseJSON[$i]['id'];
                $sales_prod->sales_id = $sale->id;
                $sales_prod->quantity = $parseJSON[$i]['qtd'];
                $sales_prod->amountItem = $parseJSON[$i]['VTotalItem'];
                $sales_prod->save();
            }
        return view("sales.comprovante",compact('parseJSON','amountSale'));
    }
    public function reportDate(Request $request){
        if(isset($request->orcamento)){
            $isOrcamento = 1;
        }
        else{
            $isOrcamento = 0;
        }
        $dateBegin = $request->dateBegin;
        $dateEnd = $request->dateEnd;

        $reports = Sale::whereBetween('sales.created_at', [$dateBegin, $dateEnd])->orWhere('orcamento', '=', $isOrcamento)->get();
      
        return view("reports.index",compact('reports'));
    }
}
