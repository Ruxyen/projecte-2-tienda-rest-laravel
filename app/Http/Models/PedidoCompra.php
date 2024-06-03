<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoCompra extends Model
{
    protected $table = 'pedidos_compra';
    protected $primaryKey = 'id';
    protected $fillable = ['fecha_pedido', 'total_pedido', 'user_id'];
    public $timestamps = false;
    
    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
        
    }
    use HasFactory;
}