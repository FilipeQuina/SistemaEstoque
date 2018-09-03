<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;


class ProductsController extends Controller
{
    public function index(){
            $products = Product::all();
            return view("products.lista",compact('products'));
        
    }
    public function novo(){
            return view("products.novo");
    }


    public function store(Request $request)
    {
        $product = new Product;
        $product->id        = $request->id;
        $product->name        = $request->name;
        $product->amountStock = $request->quantity;  
        $product->price       = str_replace(",",".",$request->price);

        $product->save();
        return redirect()->action('ProductsController@index')->with('message', 'Product created successfully!');
    }
  
    public function show(Request $request)
    {
        $products = Product::searchName($request->nome);
        return \Response::json(Product::searchName($request->nome));
    }
  
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit',compact('product'));
    }
  
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->id        = $request->id;
        $product->name        = $request->name;
        $product->amountStock = $request->quantity;  
        $product->price       = str_replace(",",".",$request->price);
        $product->save();
        
    }
  
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->action('ProductsController@index')->with('alert-success','Product hasbeen deleted!');
    }
    public function listaNomes()
    {

        return \Response::json(Product::listaNomes());
    }
}