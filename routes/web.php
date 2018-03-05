<?php

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

use  App\Models\AdminStates;
use  App\Models\AdminProvinces;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/precios', function () {
//     return view('precios');
// });

Route::get('precios', 'PreciosController@get_prices');
Route::post('calcular_precios', 'PreciosController@calcular_precios');
Route::post('recalcular_precios', 'PreciosController@recalcular_precios');

Route::get('comparsas', 'ComparsasController@index');       # Lista de las comparsas
Route::get('comparsas/nueva', 'ComparsasController@add'); # Agregar una nueva comparsa
Route::post('comparsas/nueva', 'ComparsasController@add_save_changes'); # Agregar una nueva comparsa, ya vienen los datos que ingresamos.


Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});


Route::get('ajax-get_state', function() {
    $id_province= Request::get('id_province');
    $province   = AdminProvinces::where('id', $id_province)
                    ->first();
    $states     = $province->states->toArray();
    $response   = Response::json($states);

    return $response;

});
