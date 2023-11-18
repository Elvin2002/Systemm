<?php

namespace App\Models\G_Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionesMoel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'op_ventas';
}
