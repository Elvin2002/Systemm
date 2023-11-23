@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
@if (session('mensaje'))
<div class="alert alert-success">
    {{ session('mensaje') }}
</div>
@endif
@if (session('EstadoI'))
<div class="alert alert-danger">
    {{session('EstadoI')}}
</div>
@endif
@if (session('EstadoA'))
<div class="alert alert-warning">
    {{session('EstadoA')}}
</div>
@endif
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ALMACEN</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Almacen v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-right mb-3">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg" data-backdrop="static">&nbsp; Nuevo Producto &nbsp;</button>
        </div>
        <button class="btn btn-outline-danger" id="Pdf"><i class="fa fa-file-pdf"></i></button>
        <table class="table table-bordered data-table" id="AlmacenTable">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>P. Compra</th>
                    <th>P. Venta</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- modal amigo -->
<div class="modal fade" id="modal-lg" aria-hidden="true" data-backdrop="static" style="display: none; border:solid blue 2px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1565C0;">
                <h4 class="modal-title" style="color:white">Datos Almacen</h4>
            </div>
            <div class="modal-body">
                <form id="FormAlmcen">
                    @csrf
                    <div class="box box-danger">
                        <div class="box-body">
                            <div class="row" style="margin-left: 40px;">
                                <div class="col-xs-3" style="margin-left: 20px;" hidden>
                                    <label for="">Codigo</label>
                                    <input type="text" class="form-control" name="Id" id="Id" placeholder="">
                                </div>
                                <div class="col-xs-3" style="margin-left: 20px;">
                                    <label for="">Codigo</label>
                                    <input type="text" class="form-control" name="Codigo" id="Codigo" placeholder="" require>
                                </div>
                                <div class="col-xs-4" style="margin-left: 20px;">
                                    <label for="">Producto</label>
                                    <input type="text" class="form-control" name="Productos" id="Productos" placeholder="Productos..." require>
                                </div>
                                <div class="col-xs-5" style="margin-left: 20px;">
                                    <label for="">Precio Compra</label>
                                    <input type="text" class="form-control" name="PrecioCompras" id="PrecioCompras" placeholder="P.Compras...." require>
                                </div>
                                <div class="col-xs-3" style="margin-left: 20px;">
                                    <label for="">Precio Venta</label>
                                    <input type="text" class="form-control" name="PrecioVentas" id="PrecioVentas" placeholder="P.Ventas..." require>
                                </div>
                                <div class="col-xs-4" style="margin-left: 20px;">
                                    <label for="">Entrada</label>
                                    <input type="text" class="form-control" name="Entradas" id="Entradas" placeholder="Entrada...." require>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" id="btn-exit" class="btn btn-outline-danger" data-dismiss="modal">Salir</button>
                <button type="button" id="btn-save" class="btn btn-outline-primary">Guardar</button>
            </div>
        </div>

    </div>

    <!-- modal de confirmal eliinacion -->

</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
@stop

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        var ADDAL = true
        $("#AlmacenTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                URL: '/Almacen'
            },
            columns: [{
                    data: 'Codigo',
                    name: 'Codigo'
                },
                {
                    data: 'Nombre_Producto',
                    name: 'Nombre_Producto'
                },
                {
                    data: 'Precio_Compra',
                    name: 'Precio_Compra'
                },
                {
                    data: 'Precio_Venta',
                    name: 'Precio_Venta'
                },
                {
                    data: 'Entrada',
                    name: 'Entrada'
                },
                {
                    data: 'Salida',
                    name: 'Salida'
                },
                {
                    data: 'StockActual',
                    name: 'StockActual'
                },
                {
                    data: 'Estado',
                    name: 'Estado'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            createdRow: function(row, data) {
                var estadoCell = $('td', row).eq(7);
                if (data.Estado === 'Activo') {
                    estadoCell.css('color', 'green');
                } else if (data.Estado === 'Inactivo') {
                    estadoCell.css('color', 'red');
                }
            }
        });
        $(document).on('click', "#btn-save", function() {
            var Formulario = $("#FormAlmcen").serialize();
            if (ADDAL) {
                $.post("/Almacen/Store", Formulario, function(result) {
                    window.location.href = '/Almacen';
                }).done(function(result) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Dato guardado'
                    });
                    setTimeout(function() {
                        window.location.href = "/Vehiculo";
                    }, 1001);
                });
            } else {
                var Id = $("#Id").val();
                $.ajax({
                    url: '/Almacen/update/' + Id,
                    data: Formulario,
                    method: 'PUT',
                    success: function(result) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Dato guardado'
                        });
                        setTimeout(function() {
                            window.location.href = "/Almacen";
                        }, 1001);
                    },
                    error: function() {
                        alert('error en el sistema');
                    }
                });
            }
        });

        $(document).on('click', '#btnedit', function() {
            var id = $(this).attr("data-id");
            $.getJSON('/Almacen/edit/' + id, function(data) {
                if (data.data) {
                    $("#Id").val(data.data.Id_Almacen);
                    $("#Codigo").val(data.data.Codigo);
                    $("#Productos").val(data.data.Nombre_Producto);
                    $("#PrecioCompras").val(data.data.Precio_Compra);
                    $("#PrecioVentas").val(data.data.Precio_Venta)
                    $("#Entradas").val(data.data.Entrada);
                } else if (data.error) {
                    alert("dato no encontrado" + data.error);
                }
                ADDAL = false;
            });
        });
        $(document).ready(function() {
            $.getJSON('/Almacen/codigo', function(data) {
                var num = 0;
                var num2 = 0
                $("#Codigo").val(num2 + "" + num + "" + data.Codigo);
            });
        });
        $(document).on('click', "#Pdf", function() {
            window.location.href = '/Almacen/pdf';
        });
        $(document).on('click', "#btndesactivar", function() {
            var id = $(this).attr("data-id");
            $.ajax({
                url: '/Almacen/Activar/' + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                method: 'PUT',
                success: function(result) {
                    if (result.result) {
                        window.location.href = '/Almacen';
                    }
                }
            });
        });
        $(document).on('click', "#btnactivar", function() {
            var id = $(this).attr("data-id");
            $.ajax({
                url: '/Almacen/Desactivar/' + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                method: 'PUT',
                success: function(result) {
                    if (result.result) {
                        window.location.href = '/Almacen';
                    }
                }
            });
        });
    });
</script>
@stop