<?php


namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTalla extends Model
{
    protected $table = 'producto_talla';
    protected $primaryKey = 'id_producto_talla';
    protected $fillable = ['id_talla', 'id_producto'];
 

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class, 'id_talla');
    }
}
