<?php

namespace App\Http\Controllers\G_Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportesComprasControllers extends Controller
{
    public function __construct()
    {
        $this->middleware("web");
    }
    public function Index(){
        return view("Almacen/almacen");
    }
}
