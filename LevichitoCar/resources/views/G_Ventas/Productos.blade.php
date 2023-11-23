@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
@if (session('mensaje'))
<div class="alert alert-success">
    {{ session('mensaje') }}
</div>
@endif
@stop
@section('content')
<div class="card" style="margin-top:3%; border:1px solid black">
    <div class="card-body">
        <form id="FormVentas">
            @csrf
            <select name="comboUsuarios" class="text-center" id="comboUsuarios"></select>
            <input type="text" class="Nombres" id="Nombres" name="Nombres" style="margin-left: 45px;width:20%;height:auto;">
            <input type="text" class="Apellidos" id="Apellidos" name="Apellidos" style="margin-left: 45px;width:20%;height:auto;">
            <input type="date" id="DataPiker" name="DataPiker" style="margin-left: 45px;">
            <div style="display: flex; align-items: center;" class="combo">
                <div class="venta">
                    <select id="TipoVenta" name="TipoVenta" style="font-size: 16px; margin-right: 20px;">Tipo de Venta</select>
                </div>
                <div class="Moneda">
                    <select id="TipoMoneda" name="TipoMoneda">Tipo de Moneda</select>
                </div>
            </div>
            <div class="card" style="margin-top:3%; border:1px solid black">
                <div class="card-body">
                    <table class="table" id="Table">
                        <thead>
                            <tr>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">P.UNIT</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table> <br>
                    <div style="margin-left:750px;">
                        <label style="margin-right:8px;">Total</label>
                        <input type="text" id="TotalCompras" name="TotalCompras" disabled>
                    </div>
                </div>
            </div>
        </form>
        <button type="button" class="btn btn-success" id="NuevoProducto" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-box"></i></button>
        <button id="Guardar" class="btn btn-outline-danger" style="margin-left:300px;"> <i class="fa fa-cart-shopping">Confirmar </i></button>
        <!-- modal de insertar datos -->

        <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="margin-top:-10px;" id="modalaa" role="document">
                <div class="modal-content" style=" background-color:#bdc3c7">
                    <form id="formAgregarProducto">
                        <h3 class="text-center" style="background-color: #1565C0; color:white;">Nuevo Producto</h3>
                        <div class="modal-body">
                            <input type="text" id="Id" hidden>
                            <input type="number" id="Cantidad" style="width:150px;height:auto;" placeholder="Cantidad">
                            <select id="Unidades" style="width:150px;height:auto;">
                                <option value="Unidad" selected>Unidades</option>
                                <option value="Balde">Baldes</option>
                            </select>
                            <input type="text" id="Codigo" disabled placeholder="Codigo (Opcional)" style="width:150px;height:auto;margin-bottom:15px">
                            <select id="DescripcionDetallada" name="DescripcionDetallada" style="margin-top: 10px; width:455px;"></select>
                            <div style="width:50px; margin-top:15px; margin-left:269px;">
                                <input type="text" hidden id="Producto" placeholder="Valor unitario">
                                <input type="text" id="ValorUnitario" placeholder="Valor unitario">
                                <select id="IGV" style="width:187px; margin-top:15px;">
                                    <option value="1.18">Seleccione IGV</option>
                                    <option value="1.18">18%</option>
                                    <option value="1.10">10%</option>
                                </select>
                            </div>
                            <div class="total"></div>
                            <div style="width:50px; margin-top:15px; margin-left:269px;">
                                <input id="SinIgv" type="text" disabled style="margin-top: 9px;" placeholder="sin igv">
                                <input id="VerIGV" type="text" disabled style="margin-top: 9px;" placeholder="IGV"> 
                                <input id="OPGravada" type="text" disabled placeholder="Importe TOTAL">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="Agregar" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="TableSS" id="TableSS">
            <input type="text" id="BoletaDescarga" name="BoletaDescarga" hidden>
            <table id="TablaDescarga">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Telefono</th>
                        <th>Boleta</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">

<style>
    #BodyCar {
        background-color: #bdc3c7;
    }

    #comboUsuarios {
        width: 30%;
        height: auto;
    }

    #TipoVenta {
        width: 450px;
        height: auto;
    }

    #TipoMoneda {
        width: 250px;
        height: auto;
    }

    .combo {
        margin-top: 30px;
    }

    .venta {
        margin-left: 100px;
    }

    .Moneda {
        margin-left: 100px;
        text-align: center;
    }

    #NuevoProducto {
        font-size: 30px;
        margin-left: 500px;
    }

    #Operaciones {
        width: 460px;
        height: auto;
        text-align: center;
    }

    .total {
        border-top: 1px solid black;
        margin-top: 10px;
    }
</style>
@stop

@section('js')
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var fecha = new Date().toISOString().split('T')[0];
        document.getElementById('DataPiker').value = fecha;
        $("#comboUsuarios").select2();
        $("#comboUsuarios").append('<option value="0" selected>---------DNI CLIENTES ---------</option>');
        $.getJSON("/Productos/listar/clientes", function(result) {
            $.each(result.data, function() {
                $("#comboUsuarios").append('<option value="' + this.Id_Cliente + '">' + this.DniRuc + '</option>');
            });
        });
        $("#TipoMoneda").select2();
        $("#TipoMoneda").append('<option value="SOLES" selected>SOLES</option>');
        $("#TipoMoneda").append('<option value="DOLARES">DOLARES</option>');
        $("#TipoVenta").select2();
        $.getJSON("/Productos/buscar/opciones", function(data) {
            $.each(data.dato, function() {
                $("#TipoVenta").append('<option value="' + this.Id_Opciones + '">' + this.Opciones + '</option>');
            });
        });
        $("#comboUsuarios").change(function() {
            var select = $(this).val();
            $.getJSON("/Productos/buscar/clientes/" + select, function(dni) {
                console.log(dni);
                if (dni && dni.data.length > 0) {
                    $("#Nombres").val(dni.data[0].Nombres);
                    $("#Apellidos").val(dni.data[0].Apellidos);
                    $("#BoletaDescarga").val(dni.data[0].Nombres).trigger('input');
                } else {
                    $("#Nombres").val('');
                    $("#Apellidos").val('');
                }
            });
        });
        $("#DescripcionDetallada").select2();
        $.getJSON("/Productos/List", function(opciones) {
            console.log(opciones);
            $.each(opciones.data, function() {
                if (this.StockActual >= 1) {
                    $("#DescripcionDetallada").append('<option value="' + this.Id_Almacen + '">' + this.Nombre_Producto + ' </option>');
                } else {
                    $("#DescripcionDetallada").append('<option value="' + this.Id_Almacen + '" disabled>' + this.Nombre_Producto + ' </option>');
                }
            });
        });
        var inputValue; // Variable global para almacenar el valor de ValorUnitario
        var selectValue; // Variable global para almacenar el valor de IGV
        var unidadesValue;
        var total;
        var calcigv;
        var resultado;

        function Unidades() {
            $("#Cantidad").on('input', function() {
                unidadesValue = parseFloat($(this).val()); // Almacena el valor como número
                multiplicarValores(); // Llama a la función para multiplicar los valores
            });
        }

        function ValorUnitario() {
            $("#ValorUnitario").on('input', function() {
                inputValue = parseFloat($(this).val()); // Almacena el valor como número
                multiplicarValores(); // Llama a la función para multiplicar los valores
            });
        }
        $("#DescripcionDetallada").append('<option value="" selected>--------------------PRODUCTOS------------------</option>');
        $("#DescripcionDetallada").change(function() {
            var id = $(this).val();
            $.getJSON("/Productos/Productos/codigo/" + id, function(Id) {
                $("#Codigo").val(Id.data[0].Codigo);
                $("#Producto").val(Id.data[0].Nombre_Producto);
                $("#ValorUnitario").val(Id.data[0].Precio_Venta).trigger('input');
                ValorUnitario();
            });
        });

        function IGV() {
            $("#IGV").change(function() {
                selectValue = parseFloat($(this).val()); // Almacena el valor como número
                multiplicarValores(); // Llama a la función para multiplicar los valores
            });
        }

        function multiplicarValores() {
            if (inputValue && selectValue && unidadesValue) {
                resultado = unidadesValue * inputValue;
                total = resultado * selectValue;
                calcigv = total - resultado;
                var IGV = resultado - inputValue;

                $("#SinIgv").val(resultado.toFixed(2));
                $("#VerIGV").val(calcigv.toFixed(2));
                $("#OPGravada").val(total.toFixed(2));
            }
        }
        ValorUnitario();
        IGV();
        Unidades();
        var add = true;
        var productos = [];
        var TotalPagar = 0;
        $(document).on('click', "#Agregar", function() {
            var Unidades = unidadesValue;
            var TipoUnidad = $("#Unidades").val();
            var Codigo = $("#Codigo").val();
            var Descripcion = $("#DescripcionDetallada").val();
            var Producto = $("#Producto").val();
            var ValorUnidad = inputValue;
            var IGV = selectValue;
            var SinIGV = resultado;
            var IGVCalculado = calcigv;
            var token = "{{ csrf_token() }}";
            var Final = total;
            TotalPagar += Final;

            // Agregar el producto a la tabla
            // Agregar filas a la tabla
            $("#Table tbody").append(
                "<tr>" +
                "<td>" + Unidades + "</td>" +
                "<td>" + Codigo + "</td>" +
                "<td>" + Producto + "</td>" +
                "<td>" + SinIGV + "</td>" +
                "<td>" + Final + "</td>" +
                "<td><button type='button' data-toggle='modal' data-target='#exampleModalCenter'  class='editar btn btn-outline-warning'><i class='fa fa-edit'></i></button> <button type='button' id='eliminarProducto' class='btn btn-outline-danger'><i class='fa fa-trash'></i></button></td>" +
                "</tr>"
            );

            // Cuando se hace clic en el botón "Guardar"
            $("#Table").on('click', ".editar", function() {
                var row = $(this).closest("tr");
                var indice = $(this).data("indice"); // Obtén el índice desde el atributo "data-indice"

                // Obtén los valores de la fila editada
                var Unidades = row.find("td:eq(0)").text();
                var Codigo = row.find("td:eq(1)").text();
                var Descripcion = row.find("td:eq(2)").text();
                var SinIGV = row.find("td:eq(3)").text();
                var Final = row.find("td:eq(4)").text();
            });

            // Actualizar el Total
            $("#TotalCompras").val(TotalPagar);
            $("#exampleModalCenter").modal('hide');

            // Agregar el producto al arreglo
            productos.push({
                unidades: Unidades,
                tipounidad: TipoUnidad,
                codigo: Codigo,
                descripcion: Descripcion,
                valorunitario: ValorUnidad,
                igv: IGV,
                sinigv: SinIGV,
                igvcalculado: IGVCalculado,
                final: Final,
                producto: Producto,
                _token: token
            });

            // Limpiar el formulario
            $("#formAgregarProducto")[0].reset();
        });
        $("#Guardar").on('click', function() {
            var form = {
                comboUsuarios: $("#comboUsuarios").val(),
                DataPiker: $("#DataPiker").val(),
                TipoVenta: $("#TipoVenta").val(),
                TipoMoneda: $("#TipoMoneda").val(),
                TotalCompras: $("#TotalCompras").val()
            };
            $.ajax({
                url: "/Ventasss/Store",
                method: "POST",
                data: {
                    productos,
                    form,
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    window.location.href = '/Productos';
                }
            });
        });
        $("#Table").on('click', "#editarPorducto", function() {
            var row = $(this).closest("tr");
            var Unidades = row.find("td:eq(0)").text();
            var Codigo = row.find("td:eq(1)").text();
            var Producto = row.find("td:eq(2)").text();
            var SinIGV = row.find("td:eq(3)").text();
            var Final = row.find("td:eq(4)").text();
        });
        $("#Table").on('click', "#eliminarProducto", function() {
            var row = $(this).closest("tr");
            var index = row.index();
            TotalPagar -= productos[index].final;
            row.remove();
            productos.splice(index, 1);
            $("#TotalCompras").val(TotalPagar.toFixed(2));
        });
        $("#BoletaDescarga").on('input', function() {
            var data = $(this).val();
            $.getJSON("/Emprimir/boleta/" + data, function(data) {
                console.log(data);
                $("#TablaDescarga tbody").empty();
                $.each(data.data, function() {
                    $("#TablaDescarga tbody").append("<tr>" +
                        "<td>" + this.Nombre + "</td>" +
                        "<td>" + this.Telefono + "</td>" +
                        "<td><a href='data:application/pdf;base64," + this.pdf + "' download='" + this.Nombre + ".pdf' id='actualizar'>Descargar Boleta</a></td>" +
                        "</tr>"
                    );
                });
            });
        });
    });
    $(document).ready(function() {
        $("#TablaDescarga").DataTable();
        
    });
</script>
@stop