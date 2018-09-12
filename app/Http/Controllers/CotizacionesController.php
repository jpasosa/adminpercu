<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminQuotations;
use App\Models\AdminClients;
use App\Models\AdminQuotationsProducts;
use App\Models\AdminProducts;
use App\Models\AdminExternalLinks;
use HTML;
use Redirect;

// use App\Models\AdminComparsas;
// use App\Models\AdminClients;
// use Session;
// use Illuminate\Support\Facades\DB;

use Session;
use Illuminate\Support\Facades\DB;




class CotizacionesController extends Controller
{




    public function index()
    {

        $quotations         = AdminQuotations::orderBy('id', 'desc')->paginate(30);

        $data['quotations'] = $quotations;

        return view('cotizacion_list', $data);



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
                'title'=> '',
                'price_cash_fixed'=> '',
                'price_mp_fixed'=> '',
                'description'=> '',
            ];

        $validations_texts = [  'admin_client_id.required' => 'Debe incluir el nombre del cliente.',
                                'title' => ''
                            ];




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


        return redirect('cotizaciones');

    }






    public function edit( $id )
    {

        $data['quotation']= AdminQuotations::find( $id );

        $data['quotation_products'] = AdminQuotationsProducts::where('admin_quotation_id', $id)->get();

        $data['manufacturers']  = [ 17 => 'CONTEMPORANEA',
                                    12 => 'GOPE',
                                    11 => 'IVSOM',
                                    14 => 'KING',
                                    19 => 'ROZINI',
                                    18 => 'TIMBRA',
                                ];
        $data['products']       = AdminProducts::all();

        return view('cotizacion_edit', $data);
    }




    public function edit_add_product ()
    {



            $validations = [
                'admin_quotation_id' => 'required',
                'quantity'=> 'required',
                'manufacturer_id'=> 'required',
                'product_id'=> 'required',
                'aclarations'=> '',
            ];

        $validations_texts = [  'admin_quotation_id' => 'Se produjo un error, volver a cargar la página por favor!',
                                'quantity.required' => 'Debe incluir cantidad.',
                                'manufacturer_id.required' => 'Debe especificar marca',
                                'product_id.required' => 'Debe ingresar el producto',
                            ];




        $data = request()->validate($validations, $validations_texts);


        $data_save['quantity']          = $data['quantity'];
        $data_save['admin_quotation_id']= $data['admin_quotation_id'];
        $data_save['admin_product_id']  = $data['product_id'];
        $data_save['aclarations']       = $data['aclarations'];


        $save_quotation_product = AdminQuotationsProducts::create($data_save);

        if ( $save_quotation_product ) {
            Session::flash('success_message', 'Agregamos correctamente el producto');
        } else {
            Session::flash('error_message', 'No se pudo grabar el producto. Intente más tarde, gracias!');
        }


        return redirect('cotizacion/editar/' . $data['admin_quotation_id']);



    }



    public function edit_save_data()
    {

        $validations = [
                'admin_quotation_id'=> 'required',
                'title'             => '',
                'price_cash_fixed'  => 'numeric',
                'price_mp_fixed'    => 'numeric',
                'description'       => '',
            ];

        $validations_texts = [  'admin_quotation_id' => 'Se produjo un error, volver a cargar la página por favor!',
                                'title' => '',
                                'price_cash_fixed' => '',
                                'price_mp_fixed' => '',
                                'description' => '',
                            ];




        $data = request()->validate($validations, $validations_texts);

        $id = $data['admin_quotation_id'];
        $data_save['title']         = $data['title'];
        $data_save['price_cash_fixed']= $data['price_cash_fixed'];
        $data_save['price_mp_fixed']= $data['price_mp_fixed'];
        $data_save['description']   = $data['description'];


        $update = AdminQuotations::where('id', $id)->update( $data_save );




        if ( $update ) {
            Session::flash('success_message', 'Agregamos los datos correctamente');
        } else {
            Session::flash('error_message', 'No se pudo agregar los datos de pago. Intente más tarde, gracias!');
        }

        return redirect('cotizacion/editar/' . $id );


    }




    public function quot_to_external_link( $id_quotation )
    {

        $data_link['rel_id']= $id_quotation;
        $data_link['type']  = 'cotizacion';
        $data_link['code']  = str_random(32);
        $create_link   = AdminExternalLinks::create($data_link);

        if ($create_link) {
            return 'true';
        } else {
            return 'false';
        }


    }


    public function client_see_quotation( $code_external_link )
    {

        $external_link = AdminExternalLinks::where( 'code', $code_external_link )->where( 'type', 'cotizacion')->get();

        if (count($external_link) == 0)
        {
            return Redirect::to('http://percu.com.ar');
        }

        $rel_id = $external_link[0]->rel_id;

        $data['quotation']= AdminQuotations::find( $rel_id );
        $data['quotation_products'] = AdminQuotationsProducts::where('admin_quotation_id', $rel_id)->get();

        $data['manufacturers']  = [ 17 => 'CONTEMPORANEA',
                                    12 => 'GOPE',
                                    11 => 'IVSOM',
                                    14 => 'KING',
                                    19 => 'ROZINI',
                                    18 => 'TIMBRA',
                                ];
        $data['client']       = AdminClients::find( $data['quotation']->admin_client_id );

        return view('frontend/cotizacion', $data);

    }










}
