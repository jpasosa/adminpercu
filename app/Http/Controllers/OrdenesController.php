<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Use App\Models\AdminOrders;
Use App\Models\AdminClients;
Use App\Models\AdminQuotations;
Use App\Models\AdminOrdersProducts;
Use App\Models\AdminQuotationsProducts;
Use App\Models\AdminProducts;
use App\Models\AdminExternalLinks;
Use App\Models\AdminOrdersNotes;
Use App\Models\AdminProviders;
use Session;


class OrdenesController extends Controller
{




    public function index( $status = null )
    {

        if ($status == 'abiertas') {

            $orders         = AdminOrders::where('status', 'abierta-no-abonada')
                                        ->orWhere('status', 'abierta-abonada-esperando-instrumentos')
                                        ->orWhere('status', 'abierta-abonada-instrumentos-stock')
                                        ->orWhere('status', 'abierta-abonada-en-viaje')
                                        ->orWhere('status', 'abierta-abonada-viaje-problemas')
                                        ->orWhere('status', 'ML-esperando-intrumentos')
                                        ->orWhere('status', 'ML-en-viaje')
                                        ->orWhere('status', 'ML-con-reclamos')
                                        ->orderBy('id', 'desc')->paginate(30);


        } else if ($status == 'cerradas') {

            $orders         = AdminOrders::where('status', 'cerrada')
                                        ->orWhere('status', 'ML-cerrada')
                                        ->orderBy('id', 'desc')->paginate(30);

        } else if ( $status == 'abiertas-esperando-instrumentos') {

            $orders         = AdminOrders::where('status', 'abierta-no-abonada')
                                        ->orWhere('status', 'abierta-abonada-esperando-instrumentos')
                                        ->orWhere('status', 'ML-esperando-intrumentos')
                                        ->orderBy('id', 'desc')->paginate(30);

        } else {

            $orders         = AdminOrders::orderBy('id', 'desc')->paginate(30);

        }


        $data['status'] = $status;


        $data['orders'] = $orders;

        return view('ordenes_list', $data);



    }


    public function edit( $id )
    {

        $data['order']= AdminOrders::find( $id );


        // dd($data['order']->totalCash);

        $data['orders_products'] = AdminOrdersProducts::where('admin_order_id', $id)->get();

        $data['orders_notes']   = AdminOrdersNotes::where('admin_order_id', $id)->orderBy('id', 'desc')->get();

        $data['manufacturers']  = [ 17 => 'CONTEMPORANEA',
                                    12 => 'GOPE',
                                    11 => 'IVSOM',
                                    14 => 'KING',
                                    19 => 'ROZINI',
                                    18 => 'TIMBRA',
                                ];
        $data['products']       = AdminProducts::all();

        $data['status']         = AdminOrders::getStatus();

        return view('orden_edit', $data);
    }




    public function edit_add_product ()
    {

        $validations = [
                'admin_order_id' => 'required',
                'quantity'          => 'required',
                'manufacturer_id'   => 'required',
                'product_id'        => 'required',
                'clarifications'     => '',
            ];

        $validations_texts = [  'admin_order_id'        => 'Se produjo un error, volver a cargar la página por favor!',
                                'quantity.required'         => 'Debe incluir cantidad.',
                                'manufacturer_id.required'  => 'Debe especificar marca',
                                'product_id.required'       => 'Debe ingresar el producto',
                            ];




        $data = request()->validate($validations, $validations_texts);


        $data_save['quantity']          = $data['quantity'];
        $data_save['admin_order_id']    = $data['admin_order_id'];
        $data_save['admin_product_id']  = $data['product_id'];
        $data_save['clarifications']    = $data['clarifications'];


        $save_quotation_product = AdminOrdersProducts::create($data_save);

        if ( $save_quotation_product ) {
            Session::flash('success_message', 'Agregamos correctamente el producto');
        } else {
            Session::flash('error_message', 'No se pudo grabar el producto. Intente más tarde, gracias!');
        }


        return redirect('orden/editar/' . $data['admin_order_id']);

    }

    public function edit_add_data_pay()
    {
        $validations = [
                'admin_order_id'    => 'required',
                'total_cash_fixed'  => 'nullable|numeric',
                'total_mp_fixed'    => 'nullable|numeric',
                'total_ml_fixed'    => 'nullable|numeric',
                'abonado_cash'      => 'nullable|numeric',
                'abonado_mp'        => 'nullable|numeric',
                'abonado_ml'        => 'nullable|numeric',
                'cash_send'         => 'nullable|numeric',
                'date_cash'         => 'nullable|date|date_format:m/d/Y',
                'date_mp'           => 'nullable|date|date_format:m/d/Y',
                'date_ml'           => 'nullable|date|date_format:m/d/Y',
                'date_send'         => 'nullable|date|date_format:m/d/Y',
                'empresa_send'      => '',
                'codetrack_send'    => '',
                'idcobro_mp'        => '',
                'idcobro_ml'        => '',
                'observations'      => 'nullable',
            ];

        $validations_texts = [  'admin_order_id'        => 'Se produjo un error, volver a cargar la página por favor!',
                                'total_cash_fixed.numeric'=> 'Debe ser númerico.',
                                'total_mp_fixed.numeric'=> 'Debe ser númerico.',
                                'total_ml_fixed.numeric'=> 'Debe ser númerico.',
                                'abonado_cash.numeric'  => 'Debe ser númerico.',
                                'abonado_mp.numeric'    => 'Debe ser númerico.',
                                'abonado_ml.numeric'    => 'Debe ser númerico.',
                                'cash_send.numeric'     => 'Debe ser númerico.',
                                'date_cash.date'        => 'Debe ingresar una Fecha.',
                                'date_cash.date_format' => 'Está mal el formato de la fecha.',
                                'date_mp.date'          => 'Debe ingresar una Fecha.',
                                'date_mp.date_format'   => 'Está mal el formato de la fecha.',
                                'date_ml.date'          => 'Debe ingresar una Fecha.',
                                'date_ml.date_format'   => 'Está mal el formato de la fecha.',
                                'date_send.date'        => 'Debe ingresar una Fecha.',
                                'date_send.date_format' => 'Está mal el formato de la fecha.',
                                'observations'          => '',
                            ];




        $data = request()->validate($validations, $validations_texts);


        $id     = $data['admin_order_id'];

        unset($data['admin_order_id'], $data['_token']);

        $data['date_cash']  = convert_date($data['date_cash']);
        $data['date_mp']    = convert_date($data['date_mp']);
        $data['date_ml']    = convert_date($data['date_ml']);
        $data['date_send']  = convert_date($data['date_send']);

        $update = AdminOrders::where('id', $id)
                                ->update( $data );




        if ( $update ) {
            Session::flash('success_message', 'Agregamos los datos de pago correctamente');
        } else {
            Session::flash('error_message', 'No se pudo agregar los datos de pago. Intente más tarde, gracias!');
        }

        return redirect('orden/editar/' . $id);

        // dd($update);

    }


    public function edit_change_status()
    {
        $data = request()->all();

        try {
            $update = AdminOrders::where('id', $data['admin_order_id'])
                                    ->update( ['status'=> $data['status']] );
            if ($update) {
                Session::flash('success_message', 'Se cambió el estado!');
            } else {
                Session::flash('error_message', 'No se pudo cambiar el estado.');
            }
        } catch (\PDOException $e) {
            Session::flash('error_message', 'No se pudo cambiar el estado.');
        }

        return redirect('orden/editar/' . $data['admin_order_id']);


    }


    public function edit_add_note ()
    {

        $validations = [
                'admin_order_id' => 'required',
                'note'          => 'required',
            ];

        $validations_texts = [  'admin_order_id'        => 'Se produjo un error, volver a cargar la página por favor!',
                                'note.required'         => 'Debe escribir la nota.',
                            ];




        $data = request()->validate($validations, $validations_texts);

        $insert_note = AdminOrdersNotes::create($data);

        if ( $insert_note ) {
            Session::flash('success_message', 'Agregamos correctamente la nota');
        } else {
            Session::flash('error_message', 'No se pudo agregar la nota. Intente más tarde, gracias!');
        }


        return redirect('orden/editar/' . $data['admin_order_id']);

    }









    // genero la orden desde la cotización.
    function insert_order_with_quotation_data( $id_quotation )
    {


        $quotation  = AdminQuotations::find( $id_quotation );
        $quotation_products = AdminQuotationsProducts::where('admin_quotation_id', $id_quotation)->get();


        $data_order['admin_client_id']  = $quotation->admin_client_id;
        $data_order['observations']     = $quotation->description;
        $data_order['status']           = 'abierta-no-abonada';
        $data_order['number']           = AdminOrders::get_next_number();


        $create_order   = AdminOrders::create($data_order);
        $admin_order_id = $create_order->id;

        foreach ($quotation_products AS $prod)
        {
            $data_order_product['quantity'] = $prod->quantity;
            $data_order_product['admin_order_id'] = $admin_order_id;
            $data_order_product['admin_product_id'] = $prod->admin_product_id;
            $data_order_product['clarifications'] = $prod->clarifications;
            $save_order_product = AdminOrdersProducts::create($data_order_product);
        }

        return $admin_order_id;

    }




    public function order_to_external_link( $id_order )
    {

        $data_link['rel_id']= $id_order;
        $data_link['type']  = 'orden';
        $data_link['code']  = str_random(32);
        $create_link   = AdminExternalLinks::create($data_link);

        if ($create_link) {
            return 'true';
        } else {
            return 'false';
        }


    }


    public function client_see_order( $code_external_link )
    {

        $external_link = AdminExternalLinks::where( 'code', $code_external_link )->where( 'type', 'orden')->get();


        if (count($external_link) == 0)
        {
            return Redirect::to('http://percu.com.ar');
        }

        $rel_id = $external_link[0]->rel_id;

        $data['order']= AdminOrders::find( $rel_id );

        $data['orders_products'] = AdminOrdersProducts::where('admin_order_id', $rel_id)->get();

        $data['manufacturers']  = [ 17 => 'CONTEMPORANEA',
                                    12 => 'GOPE',
                                    11 => 'IVSOM',
                                    14 => 'KING',
                                    19 => 'ROZINI',
                                    18 => 'TIMBRA',
                                ];

        $data['client']       = AdminClients::find( $data['order']->admin_client_id );

        return view('frontend/orden', $data);

    }




















}
