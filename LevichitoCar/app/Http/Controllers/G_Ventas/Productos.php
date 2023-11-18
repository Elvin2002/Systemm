<?php

namespace App\Http\Controllers\G_Ventas;

use App\Http\Controllers\Controller;
use App\Jobs\GenerarBoletas;
use App\Models\BoletaVenta;
use App\Models\G_Ventas\Detalle_VehiculosModel;
use App\Models\G_Ventas\OpcionesMoel;
use App\Models\G_Ventas\ProductosModel;
use App\Models\G_Ventas\Ventas;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;
use PDO;
use PDOException;

class Productos extends Controller
{
    public function __construct()
    {
        $this->middleware("web");
    }
    public function Index()
    {
        $datas = ListarDetalleProducto();
        return view("G_Ventas/Productos", ["datas" => $datas]);
    }
    public function ListarComboClientes()
    {
        $Consulta = ListarClientes();
        return response()->json(['data' => $Consulta]);
    }
    public function LlenarInformacionCliente($dni)
    {
        $data = LlenarClientesVentas($dni);
        return response()->json(['data' => $data]);
    }
    public function LlenarOpciones()
    {
        $data = OpcionesMoel::all();
        return response()->json(['dato' => $data]);
    }
    public function LlenarMonedas()
    {
        $data = LlenarMoneda();
        return response()->json(['data' => $data]);
    }
    public function LlenarProducto()
    {
        $data = AlmacenList();
        return response()->json(["data" => $data]);
    }
    public function LlenarCodigo($id)
    {
        $data = LlenarPrducto($id);
        return response()->json(["data" => $data]);
    }
    public function VentasStore(Request $request)
    {
        set_time_limit(120);

        try {
            $dataTime = Carbon::now();
            $form = $request->form;

            $Clientes = new Ventas();
            $Total = $form['TotalCompras'];
            $Clientes->Total = number_format($Total, 2, '.', '');
            $Clientes->Id_Cliente = $form['comboUsuarios'];
            $Clientes->FechaEmicion = $form['DataPiker'];
            $Clientes->Operaciones = $form['TipoVenta'];
            $Clientes->Moneda = $form['TipoMoneda'];
            $Clientes->Estado = "CANCELADO";
            $Clientes->save();

            $ventaId = $Clientes->getKey();
            $Productos = $request->productos;

            if ($Productos) {
                foreach ($Productos as $ProductoData) {
                    $Producto = new ProductosModel();
                    $IdAlmacen = $ProductoData['descripcion'];
                    $Unidades = $ProductoData['unidades'];
                    $AlmacenProducto = RestarAlmacen($IdAlmacen, $Unidades);
                    $Producto->Cantidad = $ProductoData['unidades'];
                    $Producto->Producto = $ProductoData['descripcion'];
                    $Producto->Unidades = $ProductoData['tipounidad'];
                    $Producto->Codigo = $ProductoData['codigo'];
                    $Producto->ValorUnitario = $ProductoData['valorunitario'];
                    $Producto->Igv = $ProductoData['igv'];
                    $IGV = $ProductoData['igvcalculado'];
                    $Producto->CalcIgv = $IGV.round($IGV);
                    $TotalDos = $ProductoData['final'];
                    Log::info($TotalDos);   
                    $Producto->Total = $TotalDos.round($TotalDos,2);
                    $Producto->Resultado = $ProductoData['sinigv'];
                    $Producto->Id_Almacen = $ProductoData['descripcion'];
                    $Producto->NProducto = $ProductoData['producto'];
                    $Producto->Id_Ventas = $ventaId;
                    $Producto->save();
                }
            }

            $data = GenerarBoletaVenta($ventaId);
            $pdf = PDF::loadView('G_Ventas.Boleta', ["data" => $data]);
            $pdfFileName = 'boleta_' . $ventaId . '.pdf';
            $pdfPath = storage_path('app/temp/' . $pdfFileName);
            $pdf->save($pdfPath);

            $Boleta = new BoletaVenta();
            $Boleta->Boleta = file_get_contents($pdfPath);
            $Boleta->Id_Ventas = $ventaId;
            $Boleta->Fecha_Emisio = $dataTime->format('y-m-d');
            $Boleta->Hora = $dataTime->format('H:i:s');
            $Boleta->save();

            $data = "Dato actualizado";
            return response()->json(["mensaje" => $data]);
        } catch (\Exception $ex) {
            // Agrega registros de log para identificar el problema
            Log::error("Error en VentasStore: " . $ex->getMessage());

            $data = "Error de ingreso de dato";
            return response()->json(["mensaje" => $data]);
        }
    }
    public function PrintBoleta($nombre){
        $data = DescargaPdf($nombre);
        return response()->json(["data"=>$data]);
    }
}
