@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
@if (session('data'))
<div class="alert alert-success">
    {{ session('data') }}
</div>
@endif
@if (session('Error'))
<div class="alert alert-warning">
    {{ session('Error') }}
</div>
@endif
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Proveedores - Empresa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Proveedor - empresa v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="pt-2 px-3">
                <h3 class="card-title">HOME</h3>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Proveedor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Empresa</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" style="margin-bottom: 10px;">
                    Nuevo
                </button>
                <table class="table" id="TableProv">
                    <thead>
                        <tr>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>EMAIL</th>
                            <th>TELEFONO</th>
                            <th>ESTADO</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td>{{ $dt->Nombres}}</td>
                            <td>{{ $dt->Apellido }}</td>
                            <td>{{ $dt->Email }}</td>
                            <td>{{ $dt->Telefono }}</td>
                            @if($dt->Estado === 1)
                            <td><span style="background-color: green; color:white;">Activo</span></td>
                            @endif
                            <td>
                                <button class="btn btn-outline-warning BTN-EDIT" data-toggle="modal" data-target="#exampleModal" data-id="{{$dt->Id_Proveedor}}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                <table class="table" id="TableE">
                    <thead>
                        <tr>
                            <th>Ruc</th>
                            <th>N.Proveedor</th>
                            <th>Estado</th>
                            <th>Tel.Prov</th>
                            <th>R.Social</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Empresa as $EM)
                        <tr>
                            <td>{{$EM->Ruc}}</td>
                            <td>{{$EM->Nombres}}</td>
                            <td>{{$EM->Estado}}</td>
                            <td>{{$EM->Telefono}}</td>
                            <td>{{$EM->RazonSocial}}</td>
                            <td>{{$EM->Direccion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- modal datos -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document" id="mddasl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1565C0;">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- -->
                <div id="spinner" style="display: none;">
                    <i class="fa fa-spinner fa-spin"></i> Cargando...
                </div>
                <form id="FormProvEmpr">
                    @csrf
                    <div class="form-group" hidden>
                        <label>Id</label>
                        <input type="text" class="form-control" id="Id" name="Id">
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" class="form-control" id="Nombres" name="Nombres" placeholder="Ingrese el Nombre">
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" id="Apellidos" name="Apellidos" placeholder="Ingrese el Apellido">
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Ingrese el Telefono">
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" class="form-control" id="Correo" name="Correo" placeholder="Ingrese el Correo">
                        </div>
                        <div class="form-group">
                            <label for="">Empresa</label>
                            <button type="button" class="form-control btn btn-default" data-toggle="modal" data-target="#modal-sm">
                                Empresa
                            </button>
                            <div class="modal fade" id="modal-sm" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header btn btn-success" >
                                            <h4 class="modal-title">Empresa</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ruc</label>
                                                <div class="form-group d-flex">
                                                    <input type="number" class="dni form-control" id="Ruc" name="Ruc" placeholder="RUC" pattern="[0-9]{8,12}" title="Debe tener entre 8 a 12 digitos numericos">
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" id="BuscarRuc" type="button"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>R.Social</label>
                                                <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" placeholder="Razon social" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Direccion</label>
                                                <input type="text" class="form-control" id="DireccionEmpresa" name="DireccionEmpresa" placeholder="Direccion Empresa" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado Empresa" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" id="canselar"> canselar</button>
                                            <button type="button" id="AddModalSave" class="btn btn-primary">Agregar</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- -->
            <div class="modal-footer">
                <button type="button" id="Salir" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success BTN-EDIT">Guardar <i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>



@stop
@section('css')
<style>
    #mddasl {
        margin-top: -10px;
    }
</style>

@stop
@section('js')
<script>
    var Add = true;

    $(document).ready(function() {
        $('#TableProv').DataTable();
        $('#TableE').DataTable();

        $("#BuscarRuc").on('click', function() {
            Ruc = $("#Ruc").val();
            $.getJSON("/Proveedores/busvar/" + Ruc, function(reset) {
                $("#RazonSocial").val(reset.data.razonSocial);
                $("#DireccionEmpresa").val(reset.data.direccion);
                $("#Estado").val(reset.data.estado);
            });
        });

        $("#AddModalSave").on('click', function() {
            $("#modal-sm").modal('hide');
        });
        $("#canselar").on('click' , function(){
            $("#modal-sm").modal('hide');
        });

        // Manejar el evento clic para el botón "Guardar"
        $("#BTN-Save").on('click', function() {
            var data = {
                Id: $("#Id").val(),
                Nombre: $("#Nombres").val(),
                Apellidos: $("#Apellidos").val(),
                Telefono: $("#Telefono").val(),
                Correo: $("#Correo").val(),
                Ruc: $("#Ruc").val(),
                RazonSocial: $("#RazonSocial").val(),
                Direccion: $("#DireccionEmpresa").val(),
                Estado: $("#Estado").val(),
                _token: "{{csrf_token()}}",
            }

            if (Add) {
                // Si es una nueva entrada, realiza la lógica de agregar
                $.post("/Proveedores/Store", data, function() {
                    window.location.href = '/Proveedor';
                });
            } else {
                // Si no es una nueva entrada, realiza la lógica de edición
                console.log("ola");
                $.post("/Proveedores/Update", data, function() {
                });
            }
        });

        // Manejar el evento clic para el botón de edición
        $(".BTN-EDIT").on('click', function() {
            var data = $(this).attr("data-id");
            $.getJSON("/Proveedores/edit/" + data, function(data) {
                $("#Id").val(data.data[0].Id_Empresa);
                $("#Nombres").val(data.data[0].Nombres);
                $("#Apellidos").val(data.data[0].Apellido);
                $("#Telefono").val(data.data[0].Telefono);
                $("#Correo").val(data.data[0].Email);
                $("#Ruc").val(data.data[0].Ruc);
                $("#RazonSocial").val(data.data[0].RazonSocial);
                $("#DireccionEmpresa").val(data.data[0].Direccion);
                $("#Estado").val(data.data[0].Estado);
                Add = false;
            });
        });
    });

</script>
@stop