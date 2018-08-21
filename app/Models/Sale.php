<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    public $timestamps = false;
    protected $fillable = ['amount','caixa2', 'qtd'];

    public function products(){
        return $this->hasMany(Product::class);
    }
    
}
