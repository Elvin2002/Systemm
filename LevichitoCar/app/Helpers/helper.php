<?php

use App\Http\Controllers\Almacen\AlmacenControllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\Almacen\AlmacenControllers as AlmacenAlmacenControllers;

function Validate($Ruc)
{
    $consulta = "SELECT * FROM clientes WHERE DniRuc = ?";
    $respuestas = DB::select($consulta, [$Ruc]);

    if (count($respuestas) > 0) {
        $data = [
            'message' => 'Registros encontrados',
            'data' => $respuestas,
        ];
    } else {
        $data = [
            'message' => 'No se encontraron registros',
            'ruc' => $Ruc,
        ];
    }
    return json_encode($data);
}

function EditCliente($id)
{

    $Consulta = "SELECT * FROM clientes WHERE Id_Cliente = ?";
    $Respuesta = DB::select($Consulta, [$id]);
    if (count($Respuesta) > 0) {
        $data =  $Respuesta;
        return $data;
    } else {
        return  null;
    }
}
function LlenarClientes()
{
    $Consulta = "SELECT Id_Cliente , Nombres FROM clientes ";
    $Resultado = DB::select($Consulta);
    return $Resultado;
}

function TIPOAceite($numero)
{

    if ($numero == 5000) {
        return 'MINERAL';
    } else if ($numero == 6000) {
        return 'SEMI-SINTETICO';
    } else if ($numero == 8000) {
        return 'SINTETICO';
    } else if ($numero == 9000) {
        return 'FULL-SINTETICO';
    }
}
function AlmacenList()
{
    $Consulta = "SELECT
                     Id_Almacen,   
                     Codigo,
                     Nombre_Producto,
                     Precio_Compra,
                     Precio_Venta,
                     Entrada,
                     Salida,
                     StockActual,
                     CASE WHEN Estado = 1 THEN 'Activo' ELSE 'Inactivo' END AS Estado
                 FROM almacen";
    $Respuesta = DB::select($Consulta);
    return $Respuesta;
}
function GenerarCodigoAlmacen()
{
    $Consulta = "SELECT MAX(Codigo) AS maxCodigo FROM almacen";
    $Respuesta = DB::select($Consulta);
    if (!empty($Respuesta) && isset($Respuesta[0]->maxCodigo)) {
        $UltimoCodigo = $Respuesta[0]->maxCodigo;
        $NuevoCodigo = $UltimoCodigo + 1;
        return $NuevoCodigo;
    } else {
        $NuevoCodigo = 1;
        return $NuevoCodigo;
    }
}
function PedidosListar()
{
    $Consulta = "SELECT Id_Almacen, Codigo, Nombre_Producto, StockActual,
                CASE WHEN Estado = 1 THEN 'Lleno' ELSE 'PEDIR' END AS Mensaje
                FROM almacen where Estado = 99";

    $Resultado = DB::select($Consulta);
    return $Resultado;
}
function ListarClientes()
{
    $Consulta = " SELECT Id_Cliente,DniRuc FROM  clientes";
    $respuestas = DB::select($Consulta);
    return $respuestas;
}
function LlenarClientesVentas($dni)
{
    $Consulta = "SELECT * FROM clientes WHERE Id_Cliente =?";
    $Respuesta = DB::select($Consulta, [$dni]);
    return $Respuesta;
}
function LlenarMoneda()
{
    $Consulta = "SELECT Id_Mondeda , Moneda FROM Mo_Venta";
    $Respuesta = DB::select($Consulta);
    return $Respuesta;
}
function ListarDetalleProducto()
{
    $Consulta = "select d.Id_DetalleVenta,
                        d.Cantidad,
                        d.Codigo,
                        a.Nombre_Producto as Producto,
                        d.ValorUnitario, 
                        d.Total
                        FROM detalle_venta as d INNER JOIN almacen as a on a.Id_Almacen = d.Producto";
    $Respuesta = DB::select($Consulta);
    return $Respuesta;
}
function EditarVehiculo($id)
{
    $Consulta = "select V.Id_Vehiculo,
    V.Id_Cliente,
    C.Nombres as clientes,
    V.Marca,
    V.Placa,
    V.K_Actual,
    V.Grado,
    V.Tipo_Aceite,
    V.K_Cambio
   from vehiculo as V INNER JOIN clientes as C ON V.Id_Cliente=C.Id_Cliente where V.Id_Vehiculo = ?";
    $Respuesta = DB::select($Consulta, [$id]);
    return $Respuesta;
}
function LlenarVehiculo()
{
    $consulta = "SELECT Id_Vehiculo, Placa from vehiculo";
    $Respuesta = DB::select($consulta);
    return $Respuesta;
}
function EditarDetalleVehiculo($id)
{
    $Consulta = "SELECT 
                DV.Id_DetalleVehiculo,
                DV.Nom_Aceite,
                DV.Grado_Aceite,
                DV.Cantidad_Aceite,
                DV.Nom_Filtro_Aceite,
                DV.Rosca_Filtro_Aceite,
                DV.Nom_Filtro_Petroleo,
                DV.Separador_Agua,
                DV.Filtro_Aire,
                DV.Refrigerante,
                DV.Porcentaje_Refrigerante,
                DV.Otros,
                DV.Id_Vehiculo,
                V.Placa
                FROM detalle_vehiculo AS DV INNER JOIN vehiculo AS V ON DV.Id_Vehiculo = V.Id_Vehiculo where DV.Id_DetalleVehiculo = ?";
    $Respuesta = DB::select($Consulta, [$id]);
    return $Respuesta;
}
function LlenarPrducto($id)
{
    $consulta = "SELECT Id_Almacen , Codigo, Nombre_Producto , Precio_Venta, StockActual FROM almacen WHERE Id_Almacen=?";
    $respuesta = DB::select($consulta, [$id]);
    if (count($respuesta) > 0) {
        return $respuesta;
    } else {
        $msg = "error dato no encontrado";
        return  $msg;
    }
}
function RestarAlmacen($IdAlmacen, $Unidades)
{
    $Consulta = AlmacenAlmacenControllers::where('Id_Almacen', $IdAlmacen)->first(); // Reemplaza 'id' con el campo adecuado para identificar el producto.
    $SalidaProducto = $Consulta->Salida;
    $Consulta->Salida = $SalidaProducto + $Unidades;
    $EntradaProducto = $Consulta->StockActual;
    $Consulta->StockActual = $EntradaProducto - $Unidades;
    if ($EntradaProducto = 5) {
        $Consulta->Estado = 99;
    }
    $Consulta->save();
}
function GenerarBoletaVenta($Id_Ventas)
{
    $Consulta = "SELECT C.DniRuc, C.Nombres, C.Apellidos, C.Telefono,
                V.FechaEmicion, V.Moneda,
                CASE
                    WHEN V.Operaciones = 1 THEN 'VENTAS INTERNO (PRODUCTOS O SERVICIOS)'
                ELSE 'OPERACION NO ENCONTRADA'
                END AS TipoOperacion,
                V.FechaEmicion, V.Moneda, V.Estado, DV.Id_DetalleVenta ,DV.Cantidad, DV.NProducto, DV.ValorUnitario, DV.Igv, DV.Resultado,DV.Codigo,DV.CalcIgv, V.Total
                FROM ventas AS V
                INNER JOIN detalle_venta AS DV ON V.Id_Ventas = DV.Id_Ventas
                INNER JOIN clientes AS C ON C.Id_Cliente = V.Id_Cliente 
                WHERE V.Id_Ventas = ?";
    $Respuesta = DB::select($Consulta, [$Id_Ventas]);
    return $Respuesta;
}
function ConsultaBoletas($desde, $hasta)
{
    $Consulta = "SELECT b.Id_Boleta, b.Boleta, b.Hora, b.Fecha_Emisio, v.Moneda, V.Total, C.Nombres, C.DniRuc
        FROM boletaventa AS b
        INNER JOIN ventas AS V ON b.Id_Ventas = v.Id_Ventas
        INNER JOIN clientes AS C ON v.Id_Cliente = c.Id_Cliente WHERE b.Fecha_Emisio BETWEEN ? AND ?";
    $Respuesta = DB::select($Consulta, [$desde, $hasta]);
    $data = [];

    if ($Respuesta) {
        foreach ($Respuesta as $boleta) {
            // Obtener el PDF de la columna Boleta
            $pdfBlob = $boleta->Boleta;

            // Codificar el PDF en base64
            $pdfData = base64_encode($pdfBlob);

            $data[] = [
                'Id_Boleta' => $boleta->Id_Boleta,
                'Fecha_Emisio' => $boleta->Fecha_Emisio,
                'Hora' => $boleta->Hora,
                'Moneda' => $boleta->Moneda,
                'Nombre' => $boleta->Nombres,
                'Ruc' => $boleta->DniRuc,
                'Total' => $boleta->Total,
                'pdf' => $pdfData,
            ];
        }

        return $data;
    } else {
        $mensaje = 'dato no encontrado';
        return $mensaje;
    }
}
function DescargaPdf($Nombre)
{
    $Consulta = "SELECT C.Telefono , C.Nombres , B.Boleta from clientes as C 
                INNER JOIN ventas as V on V.Id_Cliente = C.Id_Cliente	
                INNER JOIN boletaventa as B on B.Id_Ventas= V.Id_Ventas where C.Nombres = ? ";
    $Respuestas = DB::select($Consulta, [$Nombre]);
    $data = [];
    foreach ($Respuestas as $rpta) {
        $pdfBlob = $rpta->Boleta;
        $pdf = base64_encode($pdfBlob);

        $data[] = [
            'Nombre' => $rpta->Nombres,
            'Telefono' => $rpta->Telefono,
            'pdf' => $pdf,
        ];
    }
    return $data;
}
function ListarEmpresa()
{
    $Consulta = "SELECT PE.Id_Empresa,
                        PE.Ruc,
                        PE.RazonSocial,
                        PE.Estado,
                        PE.Direccion,
                        P.Nombres,
                        P.Telefono
                            FROM prove_empresa as PE INNER JOIN proveedor AS P ON PE.Id_Empresa = P.Id_Empresa";
    $Respuesta = DB::select($Consulta);

    return $Respuesta;
}
function EditEmpresa($id)
{
    $Consulta = "
                Select pe.Id_Empresa, pe.Ruc, pe.RazonSocial , pe.Direccion,pe.Estado,
                p.Nombres , p.Apellido , p.Email, p.Telefono 
                from prove_empresa as pe inner join proveedor as p on pe.Id_Empresa = p.Id_Empresa
                where pe.Id_Empresa = ?";
    $Respuesta = DB::select($Consulta, [$id]);
    return $Respuesta;
}
function VerDetalleVehiculo($id)
{
    $Consulta = "select dv.Nom_Aceite, dv.Filtro_Aire, dv.Nom_Filtro_Petroleo, v.Tipo_Aceite,v.Marca, v.Placa, C.Nombres, C.DniRuc  from detalle_vehiculo as dv 
    INNER JOIN vehiculo as v on dv.Id_Vehiculo = v.Id_Vehiculo 
    INNER JOIN clientes as C on v.Id_Cliente = C.Id_Cliente where dv.Id_DetalleVehiculo = ?";
    $Respuesta = DB::select($Consulta,[$id]);
    return $Respuesta;
}
