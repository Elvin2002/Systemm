<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class Dashboard extends Controller
{
    public function index()
    {
        $consulta = "SELECT COUNT(*) as total_clientes FROM clientes";
        $url = 'http://localhost:3001/ejecutar-consulta?consulta=' . urlencode($consulta);
        $response = Http::get($url);
        if ($response->successful()) {
            $datos = $response->json();
            Log::info($datos);
            return view('dashboard',["datos" => $datos]);
        } else {
            // Manejar errores si la solicitud no fue exitosa
            return response()->json(['error' => 'Error al obtener datos del servidor Express'], $response->status());
        }
    }
}
