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
use  App\Models\AdminProviders;
use  App\Models\AdminQuotationsProducts;
use  App\Models\AdminQuotations;
use  App\Models\AdminOrdersProducts;
use  App\Models\AdminProvidersProducts;
use  App\Models\AdminStockProducts;
use  App\Models\AdminClients;
use  App\Models\AdminComparsas;
use  App\Models\AdminOrders;
use  App\Models\AdminExternalLinks;
// use  App\Models\AdminQuotations;

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

Route::get('comparsa_test', 'ComparsasController@test');



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
Route::post('cotizacion/editar/agregar_data', 'CotizacionesController@edit_save_data');    # EDITAR, Graba la edición






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


// PROVEEDORES
Route::get('proveedores', 'ProveedoresController@index');       # Lista de los pedidos de Instrumentos a proveedores
Route::get('proveedor/editar/{id}', 'ProveedoresController@edit')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');
Route::post('proveedor/editar/agregar_producto', 'ProveedoresController@edit_add_product');    # EDITAR, Graba la edición
Route::post('proveedor/editar/agregar_data', 'ProveedoresController@edit_add_data');    # EDITAR, Graba la edición



// COTIZACIONES
Route::get('stock', 'StockController@index');       # Stock de los productos.
// Route::get('cotizaciones/nueva', 'CotizacionesController@add');   # Agregar una nueva cotizacion
// Route::post('cotizaciones/nueva', 'CotizacionesController@add_save_changes'); # Agregar una nueva cotizacion, ya vienen los datos que ingresamos.
// // Route::get('cotizacion/{id}', 'CotizacionesController@show')     # Vista detallada de cotizacion
// //             ->where('id', '[0-9]+');
// Route::get('cotizacion/editar/{id}', 'CotizacionesController@edit')     # EDITAR, muestra por GET
//             ->where('id', '[0-9]+');
Route::post('stock/agregar', 'StockController@add_product');    # Agrega un producto al stock




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

Route::get('ajax-erase_order_product', function() {
    $id_order_product= Request::get('id_order_product');
    $erase_order_product = AdminOrdersProducts::destroy($id_order_product);
    $response           = Response::json($erase_order_product);
    return $response;
});


Route::get('ajax-erase_provider', function() {
    $id_provider= Request::get('id_provider');

    $del_products_providers = AdminProvidersProducts::where('admin_provider_id', $id_provider)->delete();
    if ($del_products_providers) {
        $erase_provider     = AdminProviders::destroy($id_provider);
        $response           = Response::json($erase_provider);
    } else {
        $response = false;
    }
    return $response;
});



Route::get('ajax-erase_comparsa', function()
{
    $id_comparsa= Request::get('id_comparsa');
    $clientes_comparsa = AdminClients::where('admin_comparsas_id', $id_comparsa)->get();
    if (count($clientes_comparsa) > 0)
    {
        $response = 'false';
    } else {
        $erase_comparsa     = AdminComparsas::destroy($id_comparsa);
        $response           = Response::json($erase_comparsa);
    }


    return $response;
});


// elimino una cotización por AJAX
Route::get('ajax-erase_quotation', function()
{
    $id_quot= Request::get('id_quot');

    //controlo que no figure en links externos . . . .
    $quotation_links = AdminExternalLinks::where(['rel_id'=>$id_quot, 'type'=>'cotizacion'])->get();

    if ( count($quotation_links) > 0)
    {
        $response = 'false';
    } else {

        DB::table('admin_quotations_products')->where('admin_quotation_id', $id_quot)->delete();
        $control_quot = AdminQuotationsProducts::where('admin_quotation_id', $id_quot)->get();

        if ( count($control_quot) > 0) {
            // error todavia quedó algun registro relacionado cotizaciones/productos
        } else {
            $erase_quot     = AdminQuotations::destroy($id_quot);
            $response           = Response::json($erase_quot);

        }

    }


    return $response;
});



Route::get('ajax-erase_cliente', function()
{
    $id_cliente= Request::get('id_cliente');

    $clients_orders     = AdminOrders::where('admin_client_id', $id_cliente)->get();
    $clients_quotations = AdminQuotations::where('admin_client_id', $id_cliente)->get();


    if ( count($clients_orders) > 0 || count($clients_quotations) > 0 )
    {
        $response = 'false';
    } else {
        $erase_client     = AdminClients::destroy($id_cliente);
        $response           = Response::json($erase_client);
    }


    return $response;
});




Route::get('ajax-erase_stock_product', function() {
    $id_product_stock= Request::get('id_product_stock');
    $erase_stock_product = AdminStockProducts::destroy($id_product_stock);
    $response           = Response::json($erase_stock_product);
    return $response;
});

Route::get('ajax-add_stock_product', function() {
    $id_product_stock= Request::get('id_product_stock');
    $product = AdminStockProducts::where('id', $id_product_stock)->first();
    $add_one = AdminStockProducts::where('id', $id_product_stock)->update( ['quantity'=>$product->quantity + 1] );
    $response = Response::json($add_one);
    return $response;
});

Route::get('ajax-down_stock_product', function() {
    $id_product_stock= Request::get('id_product_stock');
    $product = AdminStockProducts::where('id', $id_product_stock)->first();
    $add_one = AdminStockProducts::where('id', $id_product_stock)->update( ['quantity'=>$product->quantity - 1] );
    $response = Response::json($add_one);
    return $response;
});

Route::get('ajax-quotation_to_order/{id}', 'OrdenesController@insert_order_with_quotation_data')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');

# Desde la cotización genero un link externo.
Route::get('ajax-quotation_to_external_link/{id}', 'CotizacionesController@quot_to_external_link')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');


# Desde las ordenes genero un LINK EXTERNO
Route::get('ajax-order_to_external_link/{id}', 'OrdenesController@order_to_external_link')
            ->where('id', '[0-9]+');





Route::get('ajax-quotation_to_provider/{id}', 'ProveedoresController@insert_proveedor_with_quotation_data')     # EDITAR, muestra por GET
            ->where('id', '[0-9]+');




# CLIENTES


Route::get('clientes/cotizacion/{code}', 'CotizacionesController@client_see_quotation')
            ->middleware('throttle');

Route::get('clientes/orden/{code}', 'OrdenesController@client_see_order')
            ->middleware('throttle');

Route::get('clientes/productos/en-stock', 'CotizacionesController@client_see_products_stock')
            ->middleware('throttle');