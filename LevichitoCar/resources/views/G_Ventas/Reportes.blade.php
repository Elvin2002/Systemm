@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Documetos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Documentos v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="" id="FormConsultas">
            <div class="form-group text-center">
                <label for="">Desde</label>
                <input type="date" id="desde" name="desde">
                <label for="" style="margin-left: 10%;">Hasta</label>
                <input type="date" id="hasta" name="hasta">
                <button type="button" id="btn-search" class="btn btn-outline-success" style="margin-left: 10%;"><i class="fa fa-filter"></i></button>
            </div>
        </form>
        <div class="Table" id="Table">

        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<style>
    
</style>
@stop

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        var fecha = new Date().toISOString().split('T')[0];
        document.getElementById('hasta').value = fecha;
    });
    $("#btn-search").on('click', function() {
        var DataTime = $("#FormConsultas").serialize();
        if ($("#Table").children().length === 0) {
            $.getJSON("/Reportes/Buscar/Boletas", DataTime, function(data) {
                if (data.data.length >= 1) {
                    $("#Table").append(
                        "<table id='miTabla'>" +
                        "<button type='button' id='btn-limpiar'  style='margin-right:10px;' class='btn btn-defaul text-center'>" + '<i class="fa fa-trash"></i>' + "</button>"+
                        "<button type='button' class='btn btn-defaul'>" + '<i class="fa fa-print"></i>' + "</button>" +
                        "<thead>" +
                        "<tr>" +
                        "<th>DNI</th>" +
                        "<th>Nombre</th>" +
                        "<th>Moneda</th>" +
                        "<th>Total</th>" +
                        "<th>FECHA DE EMISION</th>" +
                        "<th>Hora</th>" +
                        "<th>Boleta</th>" +
                        "</tr>" +
                        "</thead>" +
                        "<tbody></tbody>" +
                        "</table>" 
                    );
                    $.each(data.data, function() {
                        $("#miTabla tbody").append("<tr>" +
                            "<td>" + this.Ruc + "</td>" +
                            "<td>" + this.Nombre + "</td>" +
                            "<td>" + this.Moneda + "</td>" +
                            "<td>" + this.Total + "</td>" +
                            "<td>" + this.Fecha_Emisio + "</td>" +
                            "<td>" + this.Hora + "</td>" +
                            "<td><a href='data:application/pdf;base64," + this.pdf + "' download='"+this.Nombre+"-"+this.Ruc+" .pdf' >'"+this.Nombre+ "-" + this.Ruc+".pdf'</a></td>" 
                        );
                    });
                    $("#miTabla").DataTable({
                        "center": true
                    });

                    $("#btn-limpiar").click(function() {
                        // Destruye la instancia de DataTables
                        $("#miTabla").DataTable().destroy();

                        // Elimina la tabla y los botones
                        $("#miTabla, .btn-defaul, #btn-limpiar").remove();
                    });
                } else {
                    alert("Dato no encontrado");
                }
            });
        }
    });
</script>
@stop