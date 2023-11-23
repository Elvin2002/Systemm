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
                <h1 class="m-0">Detalle Vehiculo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Detalle - vehiculo v1</li>
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
            <button type="button" class=" btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">Nuevo-Detalle-Vehiculo</button>
        </div>
        <table class="table table-bordered data-table" id="detableTable">
            <thead>
                <tr>
                    <th>Mas</th>
                    <th>Aceite</th>
                    <th>Grado</th>
                    <th>Cantidad</th>
                    <th>F-aceite</th>
                    <th>N-rosca</th>
                    <th>F-aire</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- MODAL AMIGO -->
<div class="modal fade" id="modal-lg" style="display: none;" data-backdrop="static" aria-hidden="true" style="border:5px solid blue;">
    <div class="modal-dialog modal-lg" style="border: 1px solid blue;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1565C0;">
                <h4 class="modal-title" style="color: white;">DETALLE VEHICULO</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="ForDetalle">
                        @csrf
                        <div class="row">
                            <input type="text" id="Id" name="Id" style="display: none;">
                            <div class="col-md-4">
                                <label for="IdVehiculos">Vehiculos</label><br>
                                <select id="IdVehiculos" name="IdVehiculo" style="width:240px;height:auto; " class="form-control"></select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="NAceite">N.Aceite</label>
                                    <input type="text" placeholder="Nombre Aceite" id="NAceite" name="NAceite" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="GAceite">G.Aceite</label>
                                    <input type="text" placeholder="Grado Aceite" id="GAceite" name="GAceite" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Cantidad">Cantidad</label>
                                    <input type="text" placeholder="Cantidad" id="Cantidad" name="Cantidad" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FAceite">F.Aire</label>
                                    <input type="text" placeholder="Filtro de Aire" id="FAceite" name="FAceite" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="NRosca">N°Rosca</label>
                                    <input type="text" placeholder="Numero Rosca" id="NRosca" name="NRosca" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FPetroleo">F.Petroleo</label>
                                    <input type="text" placeholder="Filtro Petroleo" id="FPetroleo" name="FPetroleo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="SAgua">S.Agua</label>
                                    <input type="text" placeholder="Separador Agua" id="SAgua" name="SAgua" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FAire">F.Aire</label>
                                    <input type="text" placeholder="Filtro de aire" id="FAire" name="FAire" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Refrigerante">Refrigerante</label>
                                    <input type="text" placeholder="Refrigerante" id="Refrigerante" name="Refrigerante" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Porcentaje">Porcentaje</label>
                                    <input type="text" placeholder="Pocentaje de refigerante" id="Porcentaje" name="Porcentaje" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Otros">Otros</label>
                                    <input type="text" placeholder="Otros" id="Otros" name="Otros" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnexit" class="btn btn-outline-danger" data-dismiss="modal">Salir</button>
                <button type="button" id="btnSave" class="btn btn-outline-success">Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1565C0;">
                <h5 class="modal-title" style="color: white;">Datos Informativos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </div>

</div>



@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<style>
</style>
@stop
@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<style>

</style>
<script>
    $(document).ready(function() {
        $("#IdVehiculos").select2();
        $(document).on('click', "#btnexit", function() {
            $("#ForDetalle")[0].reset();
        });
        var ADD = true;
        $("#detableTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                URL: '/Detalle_Vehiculo',
            },
            columns: [{
                    data: 'addinfo',
                    name: 'addinfo',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'Nom_Aceite',
                    name: 'Nom_Aceite'
                },
                {
                    data: 'Grado_Aceite',
                    name: 'Grado_Aceite'
                },
                {
                    data: 'Cantidad_Aceite',
                    name: 'Cantidad_Aceite'
                },
                {
                    data: 'Nom_Filtro_Aceite',
                    name: 'Nom_Filtro_Aceite'
                },
                {
                    data: 'Rosca_Filtro_Aceite',
                    name: 'Rosca_Filtro_Aceite'
                },
                {
                    data: 'Filtro_Aire',
                    name: 'Filtro_Aire'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
        $.getJSON("/Detalle_Vehiculo/LlenarSelect", function(data) {
            console.log(data);
            $.each(data.data, function() {
                $("#IdVehiculos").append('<option value="' + this.Id_Vehiculo + '">' + this.Placa + '</option>')
            });
        });
        $(document).on("click", "#btn-info", function() {
            var data = $(this).attr("data-id");
            $.getJSON("/Detalle_Vehiculo/Ver/" + data , function(data){
                console.log(data);
            });
        });

        $(document).on('click', "#btnSave", function() {
            var formularioDetalle = $("#ForDetalle").serialize();
            if (ADD) {
                $.post("/Detalle_Vehiculo/Store", formularioDetalle, function() {
                    window.location.href = "/Detalle_Vehiculo";
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
                console.log(Id);
                $.ajax({
                    method: "put",
                    url: "/Detalle_Vehiculo/update/" + Id,
                    data: formularioDetalle,
                    success: function() {
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
                            title: 'Dato Actualzados'
                        });
                        setTimeout(function() {
                            window.location.href = "/Detalle_Vehiculo";
                        }, 1001);
                    }
                });
            }

        });
        $(document).on('click', "#btn-editar", function() {
            var id = $(this).attr("data-id");
            $.getJSON("/Detalle_Vehiculo/edit/" + id, function(data) {
                if (data.data) {
                    $("#Id").val(data.data[0].Id_DetalleVehiculo);
                    $("#IdVehiculos").val(data.data[0].Id_Vehiculo);
                    $("#NAceite").val(data.data[0].Nom_Aceite);
                    $("#GAceite").val(data.data[0].Grado_Aceite);
                    $("#Cantidad").val(data.data[0].Cantidad_Aceite);
                    $("#FAceite").val(data.data[0].Filtro_Aire);
                    $("#NRosca").val(data.data[0].Rosca_Filtro_Aceite);
                    $("#FPetroleo").val(data.data[0].Nom_Filtro_Petroleo);
                    $("#SAgua").val(data.data[0].Separador_Agua);
                    $("#FAire").val(data.data[0].Filtro_Aire);
                    $("#Refrigerante").val(data.data[0].Refrigerante);
                    $("#Porcentaje").val(data.data[0].Porcentaje_Refrigerante);
                    $("#Otros").val(data.data[0].Otros);
                } else if (data.error) {
                    alert(data.error);
                }
                ADD = false;
            });
        });


    });
</script>
@stop