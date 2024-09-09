<?php

use Illuminate\Support\Facades\Route;
use App\Models\Estaciones;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plantilla', [App\Http\Controllers\HomeController::class, 'plantilla'])->name('plantilla');


Route::get('/prueba', [App\Http\Controllers\UsuariosController::class, 'ajax_prueba']);

// usuarios
Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('listar.usuarios');
Route::post('/guardar_usuarios', [App\Http\Controllers\UsuariosController::class, 'store'])->name('guardar.usuario');
Route::post('/borrar_usuarios', [App\Http\Controllers\UsuariosController::class, 'destroy'])->name('borrar.usuario');

Route::get('apiprueba/{dato}',[App\Http\Controllers\FuncionesController::class, 'guardarFotos']);

Route::get('fotos/{id}', function ($id) { 
    $dtpr=DB::table('tblprueba')->where('codigo',$id)->count('id');
    if ($dtpr>0) {
        $dtproy=DB::table('tblprueba')->where('codigo',$id)->first();
        $dtfotos=DB::table('tblprueba2')->where('idproyecto',$dtproy->id)->orderBy('ruta','ASC')->limit(10)->get();

        $dtEsta=Estaciones::find($dtproy->estacion);

        $tdlugar=DB::table('ubigeo')->where('Codigo',$dtEsta->ubigeo)->first();

        $pdf=PDF::loadView('pruebapdf',['proyecto'=>$dtproy,'fotos'=>$dtfotos,'lugar'=>$tdlugar,'estacion'=>$dtEsta])->setPaper('a4', 'vertical');
        return $pdf->stream('reportepdf_'.$id.'.pdf');
    }else{
        return 'codigo de proyecto incorrecto';
    }
})->name('reporte.pdf');


Route::get('export', [App\Http\Controllers\FuncionesController::class, 'export'])->name('export');

Route::get('docu/{id}', [App\Http\Controllers\FuncionesController::class, 'generateDocx'])->name('exportword');

Route::get('/puntos', [App\Http\Controllers\UsuariosController::class, 'puntos'])->name('listar.puntos');
Route::post('/guardar_proy', [App\Http\Controllers\UsuariosController::class, 'saveproy'])->name('guardar.proyecto');

Route::get('/personas', [App\Http\Controllers\UsuariosController::class, 'personas'])->name('listapersonas');
Route::post('/guardar_persons', [App\Http\Controllers\UsuariosController::class, 'guardarPersona'])->name('guardarpersona');

Route::get('ajax/regalos', [App\Http\Controllers\UsuariosController::class, 'ajaxRegalos'])->name('ajaxregs');


Route::get('/departamentos', [App\Http\Controllers\UsuariosController::class, 'estaciones'])->name('listar.estaciones');
Route::post('/guardar_esta', [App\Http\Controllers\UsuariosController::class, 'estacion'])->name('guardar.estacion');

Route::get('/actividades', [App\Http\Controllers\UsuariosController::class, 'actividades'])->name('listar.actividades');
Route::post('/guardar_acti', [App\Http\Controllers\UsuariosController::class, 'actividad'])->name('guardar.acti');
Route::get('/activs/{id}', [App\Http\Controllers\UsuariosController::class, 'delactiv'])->name('borrar.actividad');


Route::get('/regalos_lst', [App\Http\Controllers\UsuariosController::class, 'list_regalos'])->name('listar.regalos');
Route::post('/guardar_reg', [App\Http\Controllers\UsuariosController::class, 'regalo'])->name('guardar.regalo');
Route::get('/regalos/{id}', [App\Http\Controllers\UsuariosController::class, 'delregalo'])->name('borrar.regalo');

Route::get('/canjes_lst', [App\Http\Controllers\UsuariosController::class, 'list_canjes'])->name('listar.canjes');
Route::post('/guardar_canje', [App\Http\Controllers\UsuariosController::class, 'canje'])->name('guardar.canje');
Route::get('/canjes/{id}', [App\Http\Controllers\UsuariosController::class, 'delcanje'])->name('borrar.canje');


Route::post('/canjear_reg', [App\Http\Controllers\UsuariosController::class, 'canjear'])->name('canjear.regalo');

Route::get('/estaciones/{id}', [App\Http\Controllers\UsuariosController::class, 'delestacion'])->name('borrar.estacion');
Route::get('/empleados/{id}', [App\Http\Controllers\UsuariosController::class, 'delempleado'])->name('borrar.empleado');
Route::get('/proyectos/{id}', [App\Http\Controllers\UsuariosController::class, 'delproy'])->name('borrar.proyecto');
