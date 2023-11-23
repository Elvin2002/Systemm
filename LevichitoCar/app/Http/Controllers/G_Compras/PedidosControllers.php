<?php

namespace App\Http\Controllers\G_Compras;

use App\Http\Controllers\Controller;
use App\Models\G_Compras\PedidosModel;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function downloadpdf(){
        $data = PedidosListar();
        Log::info($data);
       // $pdf = PDF::loadView();
    }
}
