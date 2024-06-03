<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nom_producto', 'descripcion', 'precio', 'categoria', 'talla'];
    public $timestamps = false;
    use HasFactory;
    public function tallas()
    {
        return $this->belongsToMany(Talla::class, 'producto_talla', 'id_producto', 'id_talla');
    }
}