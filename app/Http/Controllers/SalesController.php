<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        return view("sales.create");
    }
    public function novo(){
        return view("sales.novo");
    }
}
