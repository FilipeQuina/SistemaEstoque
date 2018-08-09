<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = ['codBar','name','price', 'qtd'];
    
    public function sales(){
        return $this->hasMany(Sales::class);
    }
}
