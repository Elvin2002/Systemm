<?php

use App\Http\Controllers\Almacen\AlmacenControllers;
use App\Http\Controllers\G_Compras\DocumentosControllers;
use App\Http\Controllers\G_Compras\PedidosControllers;
use App\Http\Controllers\G_Compras\ProveedoresControllers;
use App\Http\Controllers\G_Compras\ReportesComprasControllers;
use App\Http\Controllers\G_Ventas\ClienteControllers;
use App\Http\Controllers\G_Ventas\Detalle_vehiculoControllers;
use App\Http\Controllers\G_Ventas\Productos;
use App\Http\Controllers\G_Ventas\Reportes;
use App\Http\Controllers\G_Ventas\VehiculoControllers;
use App\Http\Controllers\Home\Dashboard;
use App\Http\Controllers\Perfil\PerfilControllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group( function(){
    Route::get('/home',[ Dashboard::class , 'index'])->name('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
///////////////////////////////////////////////////////G_Ventas

Route::middleware("auth")->group(function () {
    Route::get("/Clientes", [ClienteControllers::class, 'Index']);
    Route::post("/Clientes/Store", [ClienteControllers::class, 'Store']);
    Route::get("/Clientes/Edit/{id}", [ClienteControllers::class, 'Edit']);
    Route::get("/Cliente/Search/{dni}", [ClienteControllers::class, 'SearchDni']);
    Route::put("/Cliente/{id}/Update", [ClienteControllers::class, 'Update']);
});

Route::middleware("auth")->group(function () {
    Route::get("/Detalle_Vehiculo", [Detalle_vehiculoControllers::class, "Index"])->name('DetalleVehiclo.index');
    Route::get("/Detalle_Vehiculo/LlenarSelect", [Detalle_vehiculoControllers::class, "LlevarCliente"]);
    Route::post("/Detalle_Vehiculo/Store", [Detalle_vehiculoControllers::class, "Store"]);
    Route::get("/Detalle_Vehiculo/edit/{id}", [Detalle_vehiculoControllers::class, 'Edit']); //falta amigo
    Route::put("/Detalle_Vehiculo/update/{id}", [Detalle_vehiculoControllers::class, 'Update']);
    Route::get("Detalle_Vehiculo/Ver/{id}", [Detalle_vehiculoControllers::class, 'verInfo']);
});
Route::middleware("auth")->group(function () {
    Route::get("/Almacen", [AlmacenControllers::class, 'Index']);
    Route::get('/Almacen/codigo', [AlmacenControllers::class, 'ListarCodigo']);
    Route::post("/Almacen/Store", [AlmacenControllers::class, 'Store']);
    Route::get("/Almacen/edit/{id}", [AlmacenControllers::class, 'Edit']);
    Route::put("/Almacen/update/{id}", [AlmacenControllers::class, 'Update']);
    Route::put("/Almacen/Activar/{id}", [AlmacenControllers::class, 'Activar']);
    Route::put("/Almacen/Desactivar/{id}", [AlmacenControllers::class, 'Desactivar']);
    Route::get("/Almacen/pdf", [AlmacenControllers::class, 'GeneratePDF']); //mejorar amigo
});

Route::middleware("auth")->group(function () {
    Route::get("/Productos", [Productos::class, 'Index']);
    Route::get("/Productos/listar/clientes", [Productos::class, 'ListarComboClientes']);
    Route::get("/Productos/buscar/clientes/{dni}", [Productos::class, 'LlenarInformacionCliente']);
    Route::get("/Productos/List", [Productos::class, 'LlenarProducto']);
    Route::get("/Productos/buscar/opciones", [Productos::class, 'LlenarOpciones']);
    Route::get("/Productos/llenar/monedas", [Productos::class, 'LlenarMonedas']);
    Route::get("/Productos/Productos/codigo/{id}", [Productos::class, 'LlenarCodigo']);
    Route::post("/Ventasss/Store", [Productos::class, 'VentasStore']);
    Route::get("/Emprimir/boleta/{nombre}" , [Productos::class , 'PrintBoleta']);
    Route::get("/pdf", function(){return view("G_Ventas\boleta");}); // mejorar
});
Route::middleware("auth")->group(function () {
    Route::get("/Vehiculo", [VehiculoControllers::class, 'Index']);
    Route::post("/Vehiculo/Store", [VehiculoControllers::class, 'Store']);
    Route::get("/Vehiculos/LlenarCliente", [VehiculoControllers::class, 'LlenarCliente']);
    Route::get("/Vehiculo/edit/{id}", [VehiculoControllers::class, 'Edit']);
    Route::put("/Vehiculo/update/{id}", [VehiculoControllers::class, 'Update']); 
});

Route::middleware("auth")->group(function () {
    Route::get("/Perfil" , [PerfilControllers::class , 'Index']);
    Route::post("/Peril/Store" , [PerfilControllers::class, 'Store']);
});
Route::middleware("auth")->group(function () {
    Route::get("/ReportesV", [Reportes::class, 'Index'])->name('vehiculo.index');
    Route::get("/Reportes/Buscar/Boletas",[Reportes::class , 'Buscar']);
});


////////////////////////////////////////////////////////////////////G_Compras/////////////////////////////////////////////////////
//falta RP

//falta
Route::middleware("auth")->group(function () {
    Route::get("/DocuentosV", [DocumentosControllers::class, 'Index']);
    Route::post("/DocuentosV/Store", [DocumentosControllers::class, 'Store']);
    Route::get("/DocuentosV/edit/{id}", [DocumentosControllers::class, 'Edit']);
    Route::put("/DocuentosV/update/{id}", [DocumentosControllers::class, 'Update']); // falta el combo
});
//falta
Route::middleware("auth")->group(function () {
    Route::get("/Pedidos", [PedidosControllers::class, 'Index'])->name('Pedidos.Index');
    Route::get("/Pedidos/Pdf",[PedidosControllers::class , 'downloadpdf']);
});
//falta
Route::middleware("auth")->group(function () {
    Route::get("/Proveedor", [ProveedoresControllers::class, 'Index']);
    Route::post("/Proveedores/Store", [ProveedoresControllers::class, 'Store']);
    Route::get("/Proveedores/busvar/{ruc}", [ProveedoresControllers::class, 'BuscarRuc']);
    Route::get("/Proveedores/edit/{id}", [ProveedoresControllers:: class , 'Edit']);
    
});



require __DIR__ . '/auth.php';
