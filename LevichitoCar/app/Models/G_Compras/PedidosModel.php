<?php

namespace App\Models\G_Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'Almacen';
    protected $Primary_Key = 'Id_Pedidos';
}
