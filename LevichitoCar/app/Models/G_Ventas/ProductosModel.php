<?php

namespace App\Models\G_Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $table = "detalle_venta";
    protected $primaryKey = 'Id_DetalleVenta';
}
