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
                <h1 class="m-0">PEDIDOS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Pedidos v1</li>
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
            <button type="button" class="btn btn-outline-danger" id="Pdf" style="margin-right: 1000px;"><i class="fa fa-file-pdf"></i></button>
        </div>
        <table class="table table-bordered data-table" id="PedidosTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
        $("#PedidosTable").DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{route('Pedidos.Index')}}",
            columns: [{data: 'Id_Almacen',name: 'Id_Almacen'},
                      {data: 'Codigo',name: 'Codigo'},
                      {data: 'Nombre_Producto',name: 'Nombre_Productos'},
                      {data: 'StockActual',name: 'StockActual'},
                      {data: 'Mensaje',name: 'Mensaje'}
                    ]});
    }); 
    $(document).ready(function(){
        $("#Pdf").on('click', function(){
            $.getJSON("/Pedidos/Pdf" , function(){
                alert("entro");
            });
        });
    });
</script>
@stop