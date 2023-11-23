<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Almacen\AlmacenControllers as AlmacenAlmacenControllers;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDOException;
use Symfony\Contracts\Service\Attribute\Required;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class AlmacenControllers extends Controller
{
    public function __construct()
    {
        $this->middleware("web");
    }
    public function Index()
    {
        $input = request()->ajax();
        $data = AlmacenList();
        if ($input) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($data) {
                if ($data->Estado === 'Activo') {
                    $actualisar = '<button class="btn btn-outline-warning" id="btnedit" data-toggle="modal" data-target="#modal-lg" data-id="' . $data->Id_Almacen . '"> <i class="fa fa-edit"></i> </button>
                    <button class="btn btn-outline-danger" id="btndesactivar"data-id="' . $data->Id_Almacen . '"><i class="fa fa-trash" ></i></button>';
                    return $actualisar;
                } else if ($data->Estado === 'Inactivo') {
                    $actualisar = '<button class="btn btn-outline-warning"  disabled> <i class="fa fa-edit"></i> </button>
                    <button class="btn btn-outline-success" id="btnactivar"  data-id="' . $data->Id_Almacen . '"><i class="fa fa-check" ></i></button>';
                    return $actualisar;
                }
            })->rawColumns(['action'])->toJson();
        }
        return view("Almacen/almacen");
    }
    public function ListarCodigo()
    {
        $data = GenerarCodigoAlmacen();
        return response()->json(['Codigo' => $data]);
    }


    public function Store(Request $request)
    {
        try {
            
            $Data = new AlmacenAlmacenControllers();
            
            $Salida = 0;

            $Data->Codigo = $request->Codigo;
            $Data->Nombre_Producto = $request->Productos;
            $Data->Precio_Compra = $request->PrecioCompras;
            $Data->Precio_Venta = $request->PrecioVentas;

            $Entrada = $request->Entradas;
            
            $Stock = $Entrada - $Salida;
            
            $Data->Salida = $Salida;
            $Data->Entrada = $Entrada;

            $Data->StockActual = $Stock;
            $Data->Estado = 1;
            $Data->save();
            session()->flash('mensaje', 'Dato Guardado Correctamenta');
            return response()->json(['result' => true]);
        } catch (PDOException $e) {
            session()->flash('mensaje', 'error dato no encontrado' + $e->getMessage());
            return response()->json(['response' => false]);
        }
    }
    public function Edit($id)
    {
        $Data = AlmacenAlmacenControllers::find($id);
        if ($Data) {
            return response()->json(['data' => $Data]);
        } else {
            return response()->json(['error' => 'dato no encontrado']);
        }
    }
    public function Update(Request $request, $id)
    {
        try {
            $Data = AlmacenAlmacenControllers::find($id); 

            $Data->Nombre_Producto = $request->Productos;
            $Data->Precio_Compra = $request->PrecioCompras;
            $Data->Precio_Venta = $request->PrecioVentas;

            $Entrada = $request->Entradas;
            $Stock = $Entrada;
            $Data->StockActual = $Stock;
            $Data->Entrada = $Entrada;
            //$Data->Salida = $Salida;

            $Data->save();
            session()->flash('mensaje', 'Dato Actualizado');
            return response()->json(['result' => true]);
        } catch (PDOException $ex) {
            session()->flash('mensaje', 'error de sistema');
            return response()->json(['error' => 'error de sistema']);
        }
    }
    public function GeneratePDF()
    {
        $data = AlmacenAlmacenControllers::all();
        $pdf = PDF::loadView('Almacen/pdf', ['datas' => $data]);
        return $pdf->download('Reporte_1.pdf');
        // return view('Almacen/pdf', ['datas' => $data]);
        //return $pdf->stream('Reporte.pdf');
    }
    public function Activar($id)
    {
        $Desactivar = 99;
        $Data = AlmacenAlmacenControllers::find($id);
        $Data->Estado = $Desactivar;
        $Data->save();
        session()->flash('EstadoI', 'Dato Desactivado');
        return response()->json(['result' => true]);
    }
    public function Desactivar($id)
    {
        Log::info($id);
        $Activar = 1;
        $Data = AlmacenAlmacenControllers::find($id);
        $Data->Estado = $Activar;
        $Data->save();
        session()->flash('EstadoA', 'Dato Activado');
        return response()->json(['result' => true]);
    }
}
