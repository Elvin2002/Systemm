<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use App\Models\Config\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDOException;

class PerfilControllers extends Controller
{
    public function __construct()
    {
        $this->middleware("web");
    }
    public function Index()
    {
        return view("Perfil/Perfil");
    }
    public function Store(Request $request)
    {
        try {
            Log::info($request);
            $data = $request->all();
           /* if ($request->hasFile('file')) {
                $imagen = $request->file('file');
                $nombre_imagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->storeAs('public/Img', $nombre_imagen); // Guarda la imagen en storage/app/public

                $perfil = new Perfil();
                $perfil->Ruc = $request->input('Ruc');
                $perfil->Telefono = $request->input('Telefono');
                $perfil->Direccion = $request->input('Direccion');
                $perfil->imagen = $nombre_imagen; // Asigna el nombre de la imagen a la columna 'imagen'
                $perfil->save();

                session()->flash('mensaje', 'Datos guardados correctamente');
                return response()->json(["dato completo"]);
            } else {
                session()->flash('error', 'Imagen no encontrada');
                return 'No se encontró la imagen.';
            }*/
            session()->flash('mensaje', 'Datos guardados correctamente');
            return response()->json([$data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            session()->flash('error', $ex->getMessage());
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }
}
