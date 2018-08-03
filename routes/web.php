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
use  App\Models\AdminProducts;
use  App\Models\AdminQuotationsProducts;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/precios', function () {
//     return view('precios');
// });

Route::get('precios', 'PreciosController@get_prices');
Route::post('calcular_precios', 'PreciosController@calcular_precios');
Route::post('recalcular_precios', 'PreciosController@recalcular_precios');



// COMPARSAS
Route::get('comparsas', 'ComparsasController@index');       # Lista de las comparsas
Route::get('comparsas/nueva', 'ComparsasController@add');   # Agregar una nueva comparsa
Route::post('comparsas/nueva', 'ComparsasController@add_save_changes'); # Agregar una nueva comparsa, ya vienen los datos que ingresamos.
Route::get('comparsa/{id}', 'ComparsasController@show')     # Vista detallada de un cliente
            ->where('id', '[0-9]+');
Route::get('comparsa/editar/{id}', 'ComparsasController@edit')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');
Route::post('comparsa/editar/{id}', 'ComparsasController@edit_save_changes')     # EDITAR, Graba la edición
            ->where('id', '[0-9]+');




// CLIENTES
Route::get('clientes', 'ClientesController@index');             # Lista de los clientes
Route::get('cliente/{id}', 'ClientesController@show')           # Vista detallada de un cliente
            ->where('id', '[0-9]+');
Route::get('clientes/nuevo', 'ClientesController@add');         # Agregar un nuevo cliente
Route::post('clientes/nuevo', 'ClientesController@add_save_changes'); # Agregar un nuevo cliente
Route::get('cliente/editar/{id}', 'ClientesController@edit')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');
Route::post('cliente/editar/{id}', 'ClientesController@edit_save_changes')     # EDITAR, Graba la edición
            ->where('id', '[0-9]+');


// COTIZACIONES
Route::get('cotizaciones', 'CotizacionesController@index');       # Lista de las cotizaciones
Route::get('cotizaciones/nueva', 'CotizacionesController@add');   # Agregar una nueva cotizacion
Route::post('cotizaciones/nueva', 'CotizacionesController@add_save_changes'); # Agregar una nueva cotizacion, ya vienen los datos que ingresamos.
// Route::get('cotizacion/{id}', 'CotizacionesController@show')     # Vista detallada de cotizacion
//             ->where('id', '[0-9]+');
Route::get('cotizacion/editar/{id}', 'CotizacionesController@edit')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');
Route::post('cotizacion/editar/agregar_producto', 'CotizacionesController@edit_add_product');    # EDITAR, Graba la edición


// ORDENES
Route::get('ordenes/{status?}', 'OrdenesController@index');       # Lista de las cotizaciones
// Route::get('cotizaciones/nueva', 'CotizacionesController@add');   # Agregar una nueva cotizacion
// Route::post('cotizaciones/nueva', 'CotizacionesController@add_save_changes'); # Agregar una nueva cotizacion, ya vienen los datos que ingresamos.
// Route::get('cotizacion/{id}', 'CotizacionesController@show')     # Vista detallada de cotizacion
//             ->where('id', '[0-9]+');
Route::get('orden/editar/{id}', 'OrdenesController@edit')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');
Route::post('orden/editar/agregar_producto', 'OrdenesController@edit_add_product');    # EDITAR, Graba la edición
Route::post('orden/editar/agregar_datos', 'OrdenesController@edit_add_data_pay');    # EDITAR, Graba la edición de los datos de pago
Route::post('orden/editar/cambiar_estado', 'OrdenesController@edit_change_status');    # EDITAR, Cambia el estado de la ORDEN
Route::post('orden/editar/agregar_nota', 'OrdenesController@edit_add_note');    # EDITAR, Cambia el estado de la ORDEN





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


Route::get('ajax-get_product', function() {
    $id_manufacturer= Request::get('id_manufacturer');
    $products   = AdminProducts::where('oc_manufacturer_id', $id_manufacturer)->get();
    $response   = Response::json($products);

    return $response;

});


Route::get('ajax-erase_quotation_product', function() {
    $id_quotation_product= Request::get('id_quotation_product');
    $erase_quot_product = AdminQuotationsProducts::destroy($id_quotation_product);
    $response           = Response::json($erase_quot_product);
    return $response;
});
