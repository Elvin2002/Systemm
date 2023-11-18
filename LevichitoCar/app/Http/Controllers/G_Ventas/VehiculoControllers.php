<?php

namespace App\Http\Controllers\G_Ventas;

use App\Http\Controllers\Controller;
use App\Models\G_Ventas\VehiculosModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class VehiculoControllers extends Controller
{
    public function Index()
    {
        $request = request()->ajax();
        Log::info($request);
        if ($request) {
            $data = VehiculosModel::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($data) {
                $btn = '<button type="button" id="btnactualizar" class=" modalvehiculo btn-outline-warning" data-id="' . $data->Id_Vehiculo . '" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-edit"></i></button>';
                return $btn;
            })->rawColumns(['action'])->toJson();
        }
        return view('G_Ventas/Vehiculo');
    }

    public function LlenarCliente()
    {
        $data = LlenarClientes();
        if ($data) {
            return response()->json(["data" => $data]);
        } else {
            $mensaje = "error dato no encontrado";
            return response()->json([$mensaje]);
        }
    }

    public function store(Request $request)
    {
        try {
            $VehiculoData = new VehiculosModel();
            $fechaActual =  Carbon::now()->toDateString();
            $VehiculoData->Marca = strtoupper($request->Marca);
            $VehiculoData->Placa = strtoupper($request->Placa);
            $VehiculoData->K_Actual = strtoupper($request->KActual);
            $Aceite = $request->TAceite;
            $VehiculoData->Fecha = $fechaActual;
            $TipoAceite = TIPOAceite($Aceite);
            $VehiculoData->Grado = $Aceite;
            $VehiculoData->Tipo_Aceite = $TipoAceite;

            $VehiculoData->K_Cambio = strtoupper($request->Nkilometraje);
            $VehiculoData->Id_Cliente = $request->Cliente;
            $VehiculoData->save();
            session()->flash('mensaje', '¡Los daots se an guardado correctamete');
            return response()->json(['success' => true]);
        } catch (PDOException $E) {
            return response()->json(['error' => false + $E->getMessage()]);
        }
    }
    public function Edit($id)
    {

        $result = EditarVehiculo($id);
        Log::info($result);
        return response()->json(['data' => $result]);
    }

    public function Update(Request $request, $id)
    {
        try {
            $VehiculoData = VehiculosModel::find($id);
            $VehiculoData->Marca = strtoupper($request->Marca);
            $VehiculoData->Placa = strtoupper($request->Placa);
            $VehiculoData->K_Actual = strtoupper($request->KActual);
            $Aceite = $request->TAceite;
            $TipoAceite = TIPOAceite($Aceite);
            $VehiculoData->Grado = $Aceite;
            $VehiculoData->Tipo_Aceite = $TipoAceite;
            $VehiculoData->K_Cambio = strtoupper($request->Nkilometraje);
            $VehiculoData->Id_Cliente = $request->Cliente;
            $VehiculoData->save();
            session()->flash('mensaje', '¡Los datos se an actualizado correctamete');
            return response()->json(['success' => true]);
        } catch (PDOException $ex) {
            return response()->json(['error' => false + $ex->getMessage()]);
        }
    }
}
