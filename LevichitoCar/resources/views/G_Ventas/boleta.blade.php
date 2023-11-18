<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<div class="container">
    <div class="header-pdf">
        <table width="100%">
            <tr>
                <td class="text-center" width="60%">
                    <div class="div-datos">
                        <img class="img"  src="{{ asset('storage/images/images.jpg') }}"alt="" height="100" width="180">
                        <p style="font-size: 15px;"><strong>Ventas y Cambios de aceite de todo tipo de vehiculo</strong></p>
                    </div>
                    <div class="div-datos" style="font-size: 12px;">
                        <p><strong>DIRECCION:</strong> Av. César Vallejo Mz.1, Trujillo 13007- TRUJILLO - LA LIBERTAD</p>
                        <p> <strong>TELF:</strong> 916453346 - 921103276</p>
                        <!-- <p><strong>CORREO</strong>: vetntas@rcheperu.com</p> -->
                    </div>

                </td>
                <td width="40%" class="text-center">
                    <div class="correlativo-div text-center">
                        <p><strong>RUC: 10768364856</strong></p>
                        <p><strong>BOLETA ELECTRONICA</strong></p>
                        <p><strong>BO00-{{$data[0]->Id_DetalleVenta}}</strong></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 10px;">
        <table width="100%" class="tabla">
            <tr>
                <th colspan="6" class="text-center">INORMACION GENERAL</th>
            </tr>
            <th width="90px">DNI / Código:</th>
            <td> {{ $data[0]->DniRuc }}</td>
            <th width="90px">Fecha Emisión:</th>
            <td>{{$data[0]->FechaEmicion}}</td>
            <th width="90px">Tipo Moneda:</th>
            <td>{{$data[0]->Moneda}}</td>
            <tr>
                <th>Nombres:</th>
                <td colspan="3">{{$data[0]->Nombres .''. $data[0]->Apellidos}}</td>
                <th>Forma de Pago:</th>
                <td>Contado</td>
            </tr>
            <tr>
                <th>Dirección:</th>
                <td colspan="3"></td>
                <th>Medio de Pago:</th>
                <td>Efectivo</td>
            </tr>
            <tr>
                <th>E-Mail / Telf:</th>
                <td> {{$data[0]->Telefono}} </td>
                <th>N° de O/C - O/S:</th>
                <td> </td>
                <th>Fecha Vencimiento:</th>
                <td>{{$data[0]->FechaEmicion}}</td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 10px;">
        <table width="100%" class="tabla">
            <tr>
                <th width="80px">Código</th>
                <th style="width: 40px;">Cantidad</th>
                <th>Descripción Producto</th>
                <th width="100px">Precio</th>
            </tr>
            @foreach($data as $item)
            <tr>
                <td class="text-center">{{$item->Codigo}}</td>
                <td class="text-center">{{$item->Cantidad}}</td>
                <td class="text-center">{{$item->NProducto}}</td>
                <td class="text-center">{{$item->Resultado}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div style="margin-top: 10px;">
        <table width="100%" class="tabla text-center">
            <tr>
                <th>Anticipo</th>
                <th>Total Gravado </th>
                <th>Total Inafecto</th>
                <th>ICEPER</th>
                <th>Total Exonerado</th>
                <th>Dscto. Total</th>
                <th>Total IGV </th>
                <th>Impuesto total</th>
            </tr>
            <tr>
                <td>s/ 0.00</td>
                <td>s/ 0.00</td>
                <td>s/ 0.00</td>
                <td>s/ 0.00</td>
                <td>s/ 0.00</td>
                <td>s/ 0.00</td>
                <td>s/{{$data[0]->CalcIgv}}</td>
                <td>s/ {{$data[0]->Total}}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align:left;"><strong>SON: </strong> OCHOCIENTOS Y 00/100</td>
            </tr>
            <!--<tr>
                <td colspan="8" style="text-align:left;"><strong> VENDEDOR: </strong> MARCO RODRIGUEZ CONTRERAS</td>
            </tr>-->
        </table>
    </div>
    <div style="margin-top: 10px;">
        <table width="100%" class="tabla text-center">
            <tr>
                <th>Inventario</th>
                <th>Nivel de Combustible </th>
                <th>Daños pre Existentes</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 10px;">
        <table width="100%" style="font-size: 15px;">
            <tr>
                <td width="20%">
                    <div>
                        <img src="~/Content/colorlib/img/qr.jpg" width="120" height="120">
                    </div>
                </td>
                <td width="40%">
                    <div class="div-firma">
                        <p> <strong>Representación Impresa de documento electrónico</strong></p>
                        <p>Autorizado mediante Resolución Intendencia SUNAT</p>
                        <p>18/09/2023 - 10:30 AM</p>
                    </div>
                </td>
                <td width="30%">
                    <div>
                        <div style="font-size: 15px; text-align: right;">
                            <p><strong> Consulte su documento en el portal web: https://factura-2.pe/Consulta Power by: Reset Software SAC</strong></p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div style="margin-top: 10px;">
            <div style="font-size: 15px; text-align: left; width:400px;">
                <p> <strong>Factura-2 llame al 923529853-971007533 facturación electrónica al alcance de tus manos. Pregunte por nuestros planes.</strong> </p>
            </div>
        </div>
    </div>
</div>

<style>
    .correlativo-div {
        border: 1px solid black;
        margin-top: 5px;
        margin-left: 50px;
        margin-right: 50px;
        font-size: 15px;
    }

    .correlativo-div p {
        margin: 2px 0;
    }

    .div-datos p {
        margin: 2px 0;
        font-size: 12px;
        /* Aumenta el tamaño de fuente para los datos */
    }

    .text-center {
        text-align: center;
    }

    .tabla {
        border-collapse: collapse;
        font-size: 10px;
    }

    .tabla th,
    .tabla td {
        border: 0.75px solid black;
        padding: 5px;
        font-size: 10px;
        /* Ajusta el tamaño de fuente de la tabla */
    }

    .tabla th {
        background-color: #444444;
        color: white;
    }

    .div-firma {
        font-size: 15px;
    }

    .div-firma p {
        margin: 2px 0;
    }

    .tabla-firmas {
        margin-top: 120px;
        margin-bottom: 20px;
        font-size: 20px;
    }
</style>

</html>