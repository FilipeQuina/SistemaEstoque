<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales_Products extends Model
{
    protected $table = 'sales_products';
    public $timestamps = false;
    protected $fillable = ['products_id','sales_id','quantity', 'amountItem'];
    
}
