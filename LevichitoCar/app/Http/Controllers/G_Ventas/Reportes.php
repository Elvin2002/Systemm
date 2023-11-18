<?php

namespace App\Http\Controllers\G_Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Reportes extends Controller
{
    public function __construct()
    {
        $this->middleware("web");
    }
    public function Index(){
        return view("G_Ventas/Reportes");
    }
    public function Buscar(Request $request){
        $desde = $request->desde;
        $hasta = $request->hasta;
        $consulta = ConsultaBoletas($desde , $hasta);
        if($consulta){
            return response()->json(['data'=>$consulta]);
        }else{
            $msg = "dato no encontrado";
            return response()->json(['error'=>$msg]);
        }
    }
    
}
