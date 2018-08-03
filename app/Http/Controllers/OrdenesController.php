<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\AdminOrders;
Use App\Models\AdminOrdersProducts;
Use App\Models\AdminProducts;
Use App\Models\AdminOrdersNotes;
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
                                        ->orderBy('id', 'desc')->paginate(20);


        } else if ($status == 'cerradas') {

            $orders         = AdminOrders::where('status', 'cerrada')
                                        ->orWhere('status', 'ML-cerrada')
                                        ->orderBy('id', 'desc')->paginate(20);

        } else if ( $status == 'abiertas-esperando-instrumentos') {

            $orders         = AdminOrders::where('status', 'abierta-no-abonada')
                                        ->orWhere('status', 'abierta-abonada-esperando-instrumentos')
                                        ->orWhere('status', 'ML-esperando-intrumentos')
                                        ->orderBy('id', 'desc')->paginate(20);

        } else {

            $orders         = AdminOrders::orderBy('id', 'desc')->paginate(20);

        }


        $data['status'] = $status;


        $data['orders'] = $orders;

        return view('ordenes_list', $data);



    }


    public function show ( $id )
    {
        $data['client'] = AdminClients::find( $id );

        // dd($data);

        // dd($data['client']);

        return view('cliente_ver', $data);

    }




    public function add()
    {
        $clients_blank = AdminQuotations::get_blank_fields();


        return view('cotizacion_add', $clients_blank);
    }




    public function add_save_changes()
    {




        $validations = [
                'admin_client_id'=> 'required',
                'price_cash_fixed'=> '',
                'price_mp_fixed'=> '',
                'description'=> '',
            ];

        $validations_texts = ['admin_client_id.required' => 'Debe incluir el nombre del cliente.'];




        $data = request()->validate($validations, $validations_texts);

        if($data['admin_client_id'] == '')   $data['admin_client_id'] = null;


        // asigno el número.
        $quotation = DB::table('admin_quotations')
                            ->orderBy('id','desc')
                            ->limit(1)
                            ->get();
        $data['number'] = $quotation[0]->number + 1;


        $save_quotation = AdminQuotations::create($data);

        if ( $save_quotation ) {
            Session::flash('success_message', 'Grabamos correctamente la cotizacion');
        } else {
            Session::flash('error_message', 'No se pudo grabar la cotizacion. Intente más tarde, gracias!');
        }


        return redirect('home');

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
                'total_cash_fixed'  => 'numeric',
                'total_mp_fixed'    => 'numeric',
                'total_ml_fixed'    => 'numeric',
                'abonado_cash'      => 'numeric',
                'abonado_mp'        => 'numeric',
                'abonado_ml'        => 'numeric',
                'cash_send'         => 'nullable|numeric',
                'date_cash'         => 'nullable|date|date_format:m/d/Y',
                'date_mp'           => 'nullable|date|date_format:m/d/Y',
                'date_ml'           => 'nullable|date|date_format:m/d/Y',
                'empresa_send'      => '',
                'codetrack_send'    => '',
                'idcobro_mp'        => '',
                'idcobro_ml'        => '',
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
                            ];




        $data = request()->validate($validations, $validations_texts);


        $id     = $data['admin_order_id'];

        unset($data['admin_order_id'], $data['_token']);

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






    public function edit_save_changes( $id )
    {


        dd('grabar data del cliente');


        // $data = request()->validate([
        //         'name_comparsa' => 'required',
        //         'name_bateria'  => '',
        //         'facebook_page' => '',
        //         'members_cant'  => '',
        //         'can_publish'   => '',
        //         'observations'  => '',
        //         'admin_province_id'=> '',
        //         'admin_state_id'=> 'required',
        //     ],[
        //         'name_comparsa.required' => 'Debe incluir el nombre de la comparsa.',
        //         'admin_state_id.required' => 'Debe seleccionar una localidad.',
        //     ]);
        // unset($data['admin_province_id']);

        // $save = AdminComparsas::where('id', $id)
        //             ->update($data);

        // if ( $save ) {
        //     Session::flash('success_message', 'Editamos correctamente la Comparsa');
        // } else {
        //     if ( !Session::has('error_message')) {
        //         Session::flash('error_message', 'No se pudo actualizar la comparsa. Intente más tarde, gracias!');
        //     }
        // }

        // return redirect('home');

    }





























}
