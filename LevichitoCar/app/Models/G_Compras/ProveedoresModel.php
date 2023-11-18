<?php

namespace App\Models\G_Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedoresModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'proveedor';
    protected $primarykey = 'Id_Proveedor';
}
