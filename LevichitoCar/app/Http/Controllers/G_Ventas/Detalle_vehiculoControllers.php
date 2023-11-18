<?php

namespace App\Http\Controllers\G_Ventas;

use App\Http\Controllers\Controller;
use App\Models\G_Ventas\Detalle_VehiculosModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDOException;
use Yajra\DataTables\DataTables;

class Detalle_vehiculoControllers extends Controller
{
    public function __construct()
    {
        $this->middleware("web");
    }
    public function Index()
    {
        $input = request()->ajax();
        if ($input) {
            $Data = Detalle_VehiculosModel::all();
            return DataTables::of($Data)->addIndexColumn()
                ->addColumn('action', function ($Data) {
                    $btn = '<button type="button" class="btn btn-outline-warning" id="btn-editar" data-id="' . $Data->Id_DetalleVehiculo . '" data-toggle="modal" data-target="#modal-lg" >EDITAR</button>';
                    return $btn;
                })->addColumn('addinfo', function ($Data) {
                    $btn = '<button type="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-primary" id="btn-info" data-id="' . $Data->Id_DetalleVehiculo . '" data-toggle="modal" data-target="#Editar" data-backdrop="static" ><i class="fa fa-plus"></i> </button>';
                    return $btn;
                })->rawColumns(['action', 'addinfo'])->toJson();
        }
        return view("G_Ventas.Detalle_V");
    }
    public function LlevarCliente()
    {
        $data = LlenarVehiculo();
        if ($data) {
            return response()->json(["data" => $data]);
        } else {
            $mensaje = "Dato no encontrado";
            return response()->json(["mensaje" => $mensaje]);
        }
    }
    public function Store(Request $request)
    {
        try {
            Log::info($request);
            $Nuevo_Detalle_Vehiculo = new Detalle_VehiculosModel();
            $Nuevo_Detalle_Vehiculo->Nom_Aceite = strtoupper($request->NAceite);
            $Nuevo_Detalle_Vehiculo->Grado_Aceite = strtoupper($request->GAceite);
            $Nuevo_Detalle_Vehiculo->Cantidad_Aceite = strtoupper($request->Cantidad);
            $Nuevo_Detalle_Vehiculo->Nom_Filtro_Aceite = strtoupper($request->FAceite);
            $Nuevo_Detalle_Vehiculo->Rosca_Filtro_Aceite = strtoupper($request->NRosca);
            $Nuevo_Detalle_Vehiculo->Nom_Filtro_Petroleo = strtoupper($request->FPetroleo);
            $Nuevo_Detalle_Vehiculo->Separador_Agua = strtoupper($request->SAgua);
            $Nuevo_Detalle_Vehiculo->Filtro_Aire = strtoupper($request->FAire);
            $Nuevo_Detalle_Vehiculo->Refrigerante = strtoupper($request->Refrigerante);
            $Nuevo_Detalle_Vehiculo->Porcentaje_Refrigerante = strtoupper($request->Porcentaje);
            $Nuevo_Detalle_Vehiculo->Otros = strtoupper($request->Otros);
            $Nuevo_Detalle_Vehiculo->Id_Vehiculo = $request->IdVehiculo;
            $Nuevo_Detalle_Vehiculo->save();
            session()->flash('mensaje', '¡Los datos se han guardado con éxito!');
            return response()->json(['mensaje' => '¡Los datos se han guardado con éxito!']);
        } catch (PDOException $ex) {
            Log::info($ex);
            return response()->json([$ex]);
        }
    }

    public function Edit($id)
    {
        $data = EditarDetalleVehiculo($id);
        if ($data) {
            return response()->json(["data" => $data]);
        } else {
            $Mensaje = "Error dato no encontrado";
            Log::info($Mensaje);
            return response()->json(["error" => $Mensaje]);
        }
    }
    public function Update($id, Request $request)
    {
        $Nuevo_Detalle_Vehiculo = Detalle_VehiculosModel::find($id);
        $Nuevo_Detalle_Vehiculo->Nom_Aceite = strtoupper($request->NAceite);
        $Nuevo_Detalle_Vehiculo->Grado_Aceite = strtoupper($request->GAceite);
        $Nuevo_Detalle_Vehiculo->Cantidad_Aceite = strtoupper($request->Cantidad);
        $Nuevo_Detalle_Vehiculo->Nom_Filtro_Aceite = strtoupper($request->FAceite);
        $Nuevo_Detalle_Vehiculo->Rosca_Filtro_Aceite = strtoupper($request->NRosca);
        $Nuevo_Detalle_Vehiculo->Nom_Filtro_Petroleo = strtoupper($request->FPetroleo);
        $Nuevo_Detalle_Vehiculo->Separador_Agua = strtoupper($request->SAgua);
        $Nuevo_Detalle_Vehiculo->Filtro_Aire = strtoupper($request->FAire);
        $Nuevo_Detalle_Vehiculo->Refrigerante = strtoupper($request->Refrigerante);
        $Nuevo_Detalle_Vehiculo->Porcentaje_Refrigerante = strtoupper($request->Porcentaje);
        $Nuevo_Detalle_Vehiculo->Otros = strtoupper($request->Otros);
        $Nuevo_Detalle_Vehiculo->Id_Vehiculo = $request->IdVehiculo;
        $Nuevo_Detalle_Vehiculo->save();
        session()->flash('mensaje', '¡Los datos se han guardado con éxito!');
        return response()->json(['mensaje' => '¡Los datos se han guardado con éxito!']);
    }
}
