<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'tallas';
    protected $primaryKey = 'id_talla';
    protected $fillable = ['nom_talla']; 


    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_talla', 'id_talla', 'id_producto');
    }
}