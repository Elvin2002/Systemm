<?php

namespace App\Models\G_Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculosModel extends Model
{
    use HasFactory;
    protected $table ='vehiculo';
    protected $primaryKey = 'Id_Vehiculo';
    public $timestamps = false;
}
