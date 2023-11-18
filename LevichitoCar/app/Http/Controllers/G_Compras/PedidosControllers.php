<?php

namespace App\Http\Controllers\G_Compras;

use App\Http\Controllers\Controller;
use App\Models\G_Compras\PedidosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PedidosControllers extends Controller
{
    public function Index()
    {
        $Pedidos = PedidosListar();
        $input = request()->ajax();
        if ($input) {
            return DataTables::of($Pedidos)->toJson();
        }
        return view("G_Compras/pedidos");
    }
}
