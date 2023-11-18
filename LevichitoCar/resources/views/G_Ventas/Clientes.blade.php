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
                <h1 class="m-0">CLIENTES</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Clietes v1</li>
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
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static">&nbsp; Nuevo Cliente &nbsp;</button>
        </div>
        <table class="table table-bordered data-table" id="clientesTable">
            <thead>
                <tr>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Action</th> <!-- Añade una columna para acciones si es necesario -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- modal amigo-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- -->
                <div id="spinner" style="display: none;">
                    <i class="fa fa-spinner fa-spin"></i> Cargando...
                </div>
                <form id="Form">
                    @csrf
                    <div class="form-group" hidden>
                        <label>Id</label>
                        <input type="text" class="form-control" id="Id" name="Id">
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dni/Ruc</label>
                            <div class="form-group d-flex">
                                <input type="number" class="dni form-control" id="DniRuc" name="DniRuc" placeholder="DNI / RUC" pattern="[0-9]{8,12}" title="Debe tener entre 8 a 12 digitos numericos">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" id="BuscarDni" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>

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
                    </div>
                </form>
            </div>
            <!-- -->
            <div class="modal-footer">
                <button type="button" id="Salir" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="Save" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- modal de mandar mensaje amigo-->
<div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mensajes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="defecto"  name="Defecto">
                                        <label for="checkboxPrimary1">
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <label for="checkboxPrimary3">
                                            Defecto
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="Personal" name="Personal">
                                        <label for="radioPrimary1">
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <label for="radioPrimary3">
                                            Personalisado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        var ADD = true;
        $('#clientesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/Clientes',
            columns: [{
                    data: 'DniRuc',
                    name: 'DniRuc'
                },
                {
                    data: 'Nombres',
                    name: 'Nombres'
                },
                {
                    data: 'Apellidos',
                    name: 'Apellidos'
                },
                {
                    data: 'Telefono',
                    name: 'Telefono'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ],
        });
        $("#Salir").on('click', function() {
            $("#Form")[0].reset();
        });
        $(document).on('click', "#Save", function() {
            $(this).hide();
            $("#spinner").show();
            var formData = $("#Form").serialize();
            if (ADD) {
                $.post("/Clientes/Store", formData, function(response) {
                    window.location.href = "/Clientes";
                }).done(function() {
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
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Dato guardado'
                    });
                    setTimeout(function() {
                        window.location.href = "/Clientes";
                    }, 1001);
                });

            } else {
                var id = $("#Id").val();
                $.ajax({
                    url: "/Cliente/" + id + "/Update",
                    method: "PUT",
                    data: formData,
                    success: function(data) {
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
                        })
                        Toast.fire({
                            icon: 'danger',
                            title: 'Dato actualizado'
                        });
                        setTimeout(function() {
                            window.location.href = "/Clientes";
                        }, 1001);
                    },
                    error: function() {
                        alert("no entro");
                    }
                });
            }
        });
        $(document).on('click', "#btn-Edit", function() {
            var id = $(this).attr("data-id");
            $.getJSON("/Clientes/Edit/" + id, function(data) {
                $("#Id").val(data.data.Id_Cliente);
                $("#DniRuc").val(data.data.DniRuc);
                $("#Nombres").val(data.data.Nombres);
                $("#Apellidos").val(data.data.Apellidos);
                $("#Telefono").val(data.data.Telefono)
                ADD = false
            });
        });
    });
    $(document).on('click', '#BuscarDni', function() {
        var Dni = $("#DniRuc").val();
        $("#spinner").show();
        if (Dni === '') {
            return;
        } else {
            $.ajax({
                method: 'GET',
                url: '/Cliente/Search/' + Dni,
                data: {
                    Dni: Dni
                },
                success: function(data) {
                    if (data.error) {
                        alert('Error: ' + data.error);
                    } else {
                        $('#Nombres').val(data.datos.nombres);
                        $('#Apellidos').val(data.datos.apellidoPaterno + " " + data.datos.apellidoMaterno);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Dni No Valido!',
                        footer: '<a href="">Why do I have this issue?</a>'
                    })
                },
                complete: function() {
                    $("#spinner").hide();
                    $("#BuscarDni").prop("disabled", false);
                }
            });
        }
    });

    $(document).on('click' , "#btn-Numero" , function(){
        var numero = $(this).attr('data-id');
        alert(numero);
        $("#defecto").change(function() {
            if ($(this).is(':checked')) {
                var defecto = $("#defecto").val();
                $("#Personal").prop('disabled', true);
                if(defecto.lenght = 1){
                    console.log("funciona");
                }
            } else {
                $("#Personal").prop('disabled', false);
            }
        });
    });
</script>
@stop