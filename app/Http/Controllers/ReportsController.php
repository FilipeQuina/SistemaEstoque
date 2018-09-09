<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sales_Products;


class ReportsController extends Controller
{
    public function index(){
        return view("reports.index");
    }
     
}
