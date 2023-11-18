<?php

namespace App\Models\G_Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvEmpresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'Prove_Empresa';
    protected $primaryKey = 'Id_Empresa';
}
