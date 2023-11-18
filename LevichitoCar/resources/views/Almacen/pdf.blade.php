<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .table {
       margin-left: 5%;
       margin-top: 5%;
       border: 1px solid black ;
    }
</style>

<body>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Productos</th>
                <th scope="col">P. Compra</th>
                <th scope="col">P. Venta</th>
                <th scope="col">Entradas</th>
                <th scope="col">Salidas</th>
                <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
            <tr>
                <th>{{$data->Codigo}}</th>
                <td>{{$data->Nombre_Producto}}</td>
                <td>{{$data->Precio_Compra}}</td>
                <td>{{$data->Precio_Venta}}</td>
                <td>{{$data->Entrada}}</td>
                <td>{{$data->Salida}}</td>
                <td>{{$data->StockActual}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>