<?php

namespace App\Models\G_Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ventas';
    protected $primaryKey = 'Id_Ventas';
}
