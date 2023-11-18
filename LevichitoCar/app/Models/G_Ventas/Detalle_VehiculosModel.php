<?php

namespace App\Models\G_Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_VehiculosModel extends Model
{
    use HasFactory;
    protected $table = 'detalle_vehiculo';
    public $timestamps = false;
     protected $primaryKey = 'Id_DetalleVehiculo';

    
}
