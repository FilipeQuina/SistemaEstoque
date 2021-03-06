<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = ['id','name','price', 'amountStock'];
    
    public function sales(){
        return $this->hasMany(Sale::class);
    }
    public static function searchName($name){
        return static::where('name',$name)->first();
    }
    public static function listaNomes(){
        return static::select('name')->get();
    }
    public static function searchCodBar($codBar){
        echo($codBar);
        return static::where('id',$codBar)->first();
    }
}
