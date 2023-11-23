<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre de la Empresa - Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .company-info {
            text-align: center;
            margin-top: 10px;
        }

        .company-logo {
            max-width: 100px;
            max-height: 100px;
        }

        .table-container {
            width: 90%;
            margin: 20px auto;
            border: 2px solid #333;
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Lista de Productos</h1>

    <div class="company-info">
        <p>Levishito - CAR</p>
    </div>

    <div class="table-container">
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
                    <td>{{$data->Codigo}}</td>
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
    </div>
</body>

</html>
