<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalles_pedidos';
    protected $primaryKey = 'id_detalle_pedido';
    protected $fillable = ['id_pedido', 'cantidad_productos', 'precio_total'];
    public $timestamps = false;
    use HasFactory;
}
