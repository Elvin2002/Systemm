<?php

namespace App\Models\Almacen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenControllers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='almacen';
    protected $primaryKey = 'Id_Almacen';
}
