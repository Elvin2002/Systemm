@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
@if (session('mensaje'))
<div class="alert alert-success">
    {{ session('mensaje') }}
</div>
@endif
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">VEHICULO</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Vehiculo v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
<class class="card">
    <class class="card-body">
        <div class="text-right mb-3">
            <button type="button" class="btn modalvehiculo btn-outline-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static">&nbsp; Nuevo Vehiculo &nbsp;</button>
        </div>
        <table class="table table-bordered data-table" id="vehiculoTable">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>K-Actual</th>
                    <th>K-Cambio</th>
                    <th>Tipo-Aceite</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </class>
</class>
<!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" style="margin-top:-30px;" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1565C0;">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white;" >Nuevo Vehiculo</h5>
            </div>
            <div class="modal-body" style="margin-top:-30px;">
                <!-- -->
                <div id="spinner" style="display: none;">
                    <i class="fa fa-spinner fa-spin"></i> Cargando...
                </div>
                <form id="FormVehiculo">
                    @csrf
                    <div class="form-group" hidden>
                        <label>Id</label>
                        <input type="text" class="form-control" id="Id" name="Id">
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cliente</label>
                            <div class="form-group d-flex">
                                <select id="Cliente" name="Cliente" style="width: 580px; height: 40px;"></select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" class="form-control" id="Marca" name="Marca" placeholder="Ingrese el Nombre">
                        </div>
                        <div class="form-group">
                            <label>Placa</label>
                            <input type="text" class="form-control" id="Placa" name="Placa" placeholder="Ingrese el Apellido">
                        </div>
                        <div class="form-group">
                            <label>Kilometraje Actual</label>
                            <input type="number" class="form-control" id="KActual" name="KActual" placeholder="Ingrese el Telefono">
                        </div>
                        <div class="form-group">
                            <label>Tipo De Aceite</label>
                            <div class="form-group d-flex">
                                <select id="TAceite" name="TAceite" style="width: 580px; height: 40px;">
                                    <option class="text-center" value="" selected>---- SELECCIONAR -----</option>
                                    <option class="text-center" value="5000">MINERAL</option>
                                    <option class="text-center" value="6000">SEMI - SINTETICO</option>
                                    <option class="text-center" value="8000">SINTETICO</option>
                                    <option class="text-center" value="9000">FULL SINTETICO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nuevo Kilometraje</label>
                            <input type="text" class="form-control" id="NKilometraje" name="Nkilometraje" placeholder="Ingrese el Telefono" disabled>
                        </div>
                    </div>
                </form>
                <div class="modal-footer" style="margin-top:-45px">
                    <button type="button" id="btnsalir" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-Guardar-vehiculo" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<style>
    #spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 20px;
        border-radius: 5px;
        display: none;
    }

    i.fa-spinner {
        font-size: 48px;
    }
</style>
@stop
@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var ADDVS = true;
        $("#Cliente").append('<option value="" selectd>------SELECCIONAR------<option>');
        $("#Cliente").select2();
        $.getJSON("/Vehiculos/LlenarCliente", function(data) {
            $.each(data.data, function() {
                $("#Cliente").append('<option value="' + this.Id_Cliente + '"> ' + this.Nombres + '</option>')
            });
        });
        $('#vehiculoTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/Vehiculo",
            columns: [{
                    data: 'Marca',
                    name: 'Marca'
                },
                {
                    data: 'Placa',
                    name: 'Placa'
                },
                {
                    data: 'K_Actual',
                    name: 'K_Actual'
                },
                {
                    data: 'K_Cambio',
                    name: 'K_Cambio'
                },
                {
                    data: 'Tipo_Aceite',
                    name: 'Tipo_Aceite'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });


        $(document).on("click", "#btnsalir", function() {
            $("#FormVehiculo")[0].reset();
        });

        $("#KActual").on('input', function() {
            SumarCampo();
        });
        $("#TAceite").on('change', function() {
            SumarCampo();
        });

        function SumarCampo() {
            var kilometraje = parseFloat($("#KActual").val()) || 0;
            var Tipo = parseFloat($("#TAceite").val()) || 0;
            var suma = kilometraje + Tipo;
            var salida = $("#NKilometraje").val(suma);
        }
        $(document).on("click", "#btn-Guardar-vehiculo", function() {
            var token = $("#FormVehiculo").find("input[name='_token']").val();
            $("#spinner").show();
            var data = {
                _token: token,
                Id: ADDVS ? 0 : $("#Id").val(),
                Cliente: $("#Cliente").val(),
                Marca: $("#Marca").val(),
                Placa: $("#Placa").val(),
                KActual: $("#KActual").val(),
                TAceite: $("#TAceite").val(),
                Nkilometraje: $("#NKilometraje").val(),
            };
            if (ADDVS) {
                $.post("/Vehiculo/Store", data, function(result) {
                    if (result.success) {
                        window.location.href = "/Vehiculo";
                    }
                }).done(function(data) {
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
                var id = data.Id;
                $.ajax({
                    url: "/Vehiculo/update/" + id,
                    type: "PUT",
                    data: data,
                    success: function(result) {
                        if (result.success) {
                            window.location.href = "/Vehiculo"
                        }
                    }
                }).success(function() {
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


            }
        });
        $(document).on("click", "#btnactualizar", function() {
            var id = $(this).attr("data-id");
            $.getJSON('/Vehiculo/edit/' + id, function(result) {
                console.log(result.data);
                $("#Id").val(result.data[0].Id_Vehiculo);
                $("#Marca").val(result.data[0].Marca);
                $("#Placa").val(result.data[0].Placa);
                $("#KActual").val(result.data[0].K_Cambio);
                $("#NKilometraje").val(result.data[0].TAceite);
                $("#TAceite").val(result.data[0].Grado);
                $("#Cliente").val(result.data[0].Id_Cliente);
                ADDVS = false;
            });
        });
    });
</script>
@stop