<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    public $timestamps = true;
    protected $fillable = ['id','amount','caixa2', 'qtd'];

    public function products(){
        return $this->hasMany(Products::class);
    }
}
