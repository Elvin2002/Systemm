<?php

namespace App\Http\Controllers\G_Compras;

use App\Http\Controllers\Controller;
use App\Models\G_Compras\ProveedoresModel;
use App\Models\G_Compras\ProvEmpresa;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProveedoresControllers extends Controller
{
    public function Index()
    {

        $data = ProveedoresModel::all();
        $Empresa = ListarEmpresa();
        return view('G_Compras/proveedor', compact('data' , 'Empresa'));
    }
    public function BuscarRuc($Ruc)
    {
        $Get_Ruc = $Ruc;
        $cliente = new Client();
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImVsdmludmFyYXNtZXJlZ2lsZG9AZ21haWwuY29tIn0.cX1x_THxar2-cH1N1cbFmDOSaPurDu94dUlDViIa2WM";
        $url = "https://dniruc.apisperu.com/api/v1/ruc/{$Get_Ruc}?token={$token}";

        try {
            $curl = $cliente->get($url);
            $response = json_decode($curl->getBody(), true);
            Log::info($response);
            return response()->json(['data' => $response]);
        } catch (\Exception $ex) {
            Log::info($ex);
        }
    }
    public function Store(Request $request)
    {

        try {
            Log::info($request);
            $Nombre = $request->Nombre;
            $Apellidos = $request->Apellidos;
            $Telefono = $request->Telefono;
            $Correo = $request->Correo;


            $Ruc = $request->Ruc;
            $RazonSocial = $request->RazonSocial;
            $Direccion = $request->Direccion;
            $Estado = $request->Estado;

            $Empresa = new ProvEmpresa();
            $Empresa->Ruc = $Ruc;
            $Empresa->RazonSocial = strtoupper($RazonSocial);
            $Empresa->Estado = strtoupper($Estado);
            $Empresa->Direccion = strtoupper($Direccion);
            $Empresa->save();
            Log::info('1. Guaro la empresa');
            $IdEmpresa = $Empresa->getKey();
            $this->StoreCliente($IdEmpresa, $Nombre, $Apellidos, $Telefono, $Correo);
        } catch (\Exception $ex) {
            $error = Session()->flash('error', $ex->getMessage());
            Log::info($ex);
            return $error;
        }
    }
    protected function StoreCliente($IdEmpresa, $Nombre, $Apellidos, $Telefono, $Correo)
    {
        try{
            Log::info('1. Entro al proveedor');
            $Proveedor = new ProveedoresModel();
            $Proveedor->Nombres = strtoupper($Nombre);
            $Proveedor->Apellido = strtoupper($Apellidos);
            $Proveedor->Email = $Correo;
            $Proveedor->Telefono = $Telefono;
            $Proveedor->Estado = 1;
            $Proveedor->Id_Empresa = $IdEmpresa;
            $Proveedor->save();
            Session()->flash('data' , 'Dato guardado correctamente');
            Log::info('1. Guaro el proveedor');
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
            $error = Session()->flash('Error', $ex->getMessage());
            return $error;
        }
    }
    public function Edit($id){
        $data = EditEmpresa($id);
        if($data){
            return response()->json(["data"=> $data]);
        }
        else{
            return Session()->flash("error","dato no encontrado");
        }
    }
}
