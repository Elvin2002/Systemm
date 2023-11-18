<?php

namespace App\Http\Controllers\G_Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\G_Ventas\ClientesModel;
use Carbon\Carbon;
use PDOException;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Client;
use PDO;
use Yajra\DataTables\Html\Editor\Editor;

class ClienteControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
    public function Index()
    {
        if (request()->ajax()) {
            $data = ClientesModel::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($datas) {
                    $btn = '<button type="button" id="btn-Edit" class="editar btn btn-outline-warning" data-id="' . $datas->Id_Cliente . '"  data-toggle="modal" data-target="#exampleModal" data-backdrop="static"><i class="fa fa-edit"></i></button>
                            <button type="button" id="btn-Numero" class="editar btn btn-outline-warning" data-id="' . $datas->Telefono . '"  data-toggle="modal" data-target="#modal-default" data-backdrop="static"><i class="fa fa-edit"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('G_Ventas/Clientes');
    }
     public function Store(Request $request)
    {
        try {
            $FechaActual = Carbon::now();
            $Clientes = new ClientesModel();
            $DniRuc = $request->DniRuc;
            $DniValidar = Validate($DniRuc);
            $data = json_decode($DniValidar, true);
            $mensaje = $data['message'];
            if ($mensaje === 'Registros encontrados') {
                session()->flash('mensaje', '¡El dato ya existe!');
                return response()->json(['mensaje' => '¡El dato ya existe!']);
            } else {
                $Clientes->DniRuc = $DniRuc;
                $Clientes->Nombres = $request->Nombres;
                $Clientes->Apellidos = $request->Apellidos;
                $Clientes->Telefono = $request->Telefono;
                $Clientes->FechaHora = $FechaActual;
                $Clientes->save();
                session()->flash('mensaje', '¡Los datos se han guardado con éxito!');
                return response()->json(['mensaje' => '¡Los datos se han guardado con éxito!']);
            }
        } catch (PDOException $ex) {
            return response()->json(['mensaje' => 'Error en la base de datos']);
        }
    }
    public function Edit($id)
    {
        $data = ClientesModel::find($id);
        return response()->json(['data' => $data]);
    }

    public function SearchDni($data)
    {
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImVsdmludmFyYXNtZXJlZ2lsZG9AZ21haWwuY29tIn0.cX1x_THxar2-cH1N1cbFmDOSaPurDu94dUlDViIa2WM        ";
        $url = "https://dniruc.apisperu.com/api/v1/dni/{$data}?token={$token}";
        $cliente = new Client();
        try {
            $response = $cliente->get($url);
            $datas = json_decode($response->getBody(), true);
            return response()->json(['datos' => $datas]);
        } catch (PDOException $e) {
            return response()->json(['error' => 'Hubo un error en la solicitud.'], 500);
        }
    }
    public function Update(Request $request, $id)
    {
        Log::info($request);
        $Clientes = ClientesModel::find($id);
        $Clientes->DniRuc = $request->DniRuc;
        $Clientes->Nombres = $request->Nombres;
        $Clientes->Apellidos = $request->Apellidos;
        $Clientes->Telefono = $request->Telefono;
        $Clientes->save();
        session()->flash('mensaje', '¡Los datos se han actualizado con éxito!');
        return response()->json(['mensaje' => '¡Los datos se han guardado con éxito!']);
    }
}
