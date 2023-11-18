@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
@if (session('mensaje'))
<div class="alert alert-success">
    {{ session('mensaje') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('mensaje') }}
</div>
@endif
<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="true">Settings</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="custom-tabs-one-tabContent">
        <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

            <div class="card-body box-profile">
                <div class="text-center">
                    <button type="button" data-toggle="modal" data-target="#modal-default" style="padding: 0; border: none; background: none;" id="Imagen">
                        <img class="profile-user-img" src="{{ asset('Img/images.jpg') }}" alt="Logo" style="width: 400px; height: auto; margin: 0;">
                    </button>
                </div>
                <h3 class="profile-username text-center">Levishito Car</h3>
                <p class="text-muted text-center">Lubricentro</p>
                <ul class="list-group list-group-horizontal-md mb-3" style="margin-left: 250px;">
                    <li class="list-group-item">
                        <b>Ruc</b>:&nbsp; <a class="float-right">1076836485</a>
                    </li>
                    <li class="list-group-item">
                        <b>Teléfono</b>:&nbsp;<a class="float-right">921103276</a>
                    </li>
                    <li class="list-group-item">
                        <b>Estado</b>:&nbsp;<span class="float-right alert-success">Activo</span>
                    </li>
                </ul>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Acerca de mi</h3>
                </div>

                <div class="card-body">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                    <p class="text-muted">Av. César Vallejo Mz.1, Trujillo 13007</p>
                    <a href="https://www.google.com/maps/place/LEVISHITO+CAR/@-8.0970147,-79.0090709,17z/data=!3m1!4b1!4m6!3m5!1s0x91ad17038625d611:0x1bd8b91e96d2355e!8m2!3d-8.09702!4d-79.006496!16s%2Fg%2F11ny4pz0_5?authuser=0&entry=ttu">Ver</a>
                </div>
            </div>
        </div>
        <!-- Registrar USUARIOS -->
        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register a new membership</p>
                    <form action="../../index.html" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">

        </div>
        <div class="tab-pane fade active show" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #00B4DB;">
                <h4 class="modal-title">Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="FormEmpresa" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Imagen</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        <div class="text-center mt-2">
                            <img id="imgagenvista" src="" alt="" class="img-fluid" style="max-width: 150px; height: auto;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Ruc">Ruc</label>
                        <input type="number" class="form-control" id="Ruc" name="Ruc">
                    </div>

                    <div class="form-group">
                        <label for="Telefono">Telefono</label>
                        <input type="number" class="form-control" id="Telefono" name="Telefono">
                    </div>

                    <div class="form-group">
                        <label for="Direccion">Direccion</label>
                        <input type="text" class="form-control" id="Direccion" name="Direccion">
                    </div>
                </div>
            </form>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal">

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
        /*$("#file").change(function() {
            var input = this;
            var imagenver = $("#imgagenvista");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagenver.attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });*/
        $data = [];
        $("#btn-save").on('click', function() {
            var img = $('#file').val(); 
            var Ruc = $('#Ruc').val();
            var Telefono= $('#Telefono').val();
            var Direccion = $('#Direccion').val();
            $.ajax({
                url: "/Peril/Store",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    formData: formData
                },
                success: function(response) {
                   // window.location.href = "/Perfil";
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    });
</script>
@stop