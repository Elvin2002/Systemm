<?php

namespace App\Models\G_Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesModel extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    public $timestamps = false;
    protected $primaryKey = 'Id_Cliente';

}
