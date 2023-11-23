@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<!-- Header content aquí -->
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <iframe title="dasboard" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=3afc137f-5b5c-4a63-b43f-53a939fb6270&autoAuth=true&ctid=b4a40545-7779-4b38-aff7-1f1738f80840" frameborder="0" allowFullScreen="true"></iframe>
    </div>
</div>
@stop

@section('js')
<!-- En tu vista Laravel (por ejemplo, dashboard.blade.php) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
<script>
    //const socket = io('http://localhost:3001');
    /*socket.on('query-resultado', (resultados) => {
        const resultadosContainer = document.getElementById('resultados-container');
        resultadosContainer.innerHTML = JSON.stringify(resultados, null, 2);
    });
    console.log(socket);*/
</script>

@stop
