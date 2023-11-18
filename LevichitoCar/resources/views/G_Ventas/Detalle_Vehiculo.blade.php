@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">CLIENTES</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Clietes v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 1</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Tarjeta 2</p>
            </div>
        </div>
    </div>
    <!-- Repite esto para más tarjetas -->
</div>

<div class="row">
    <!-- Repite las columnas anteriores para crear más filas -->
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
@stop
@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>

</script>
@stop