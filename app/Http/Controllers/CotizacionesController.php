<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminQuotations;

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

        $quotations         = AdminQuotations::orderBy('id', 'desc')->paginate();

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

        $data['cliente']    = AdminClients::find( $id );
        $cliente            = $data['cliente'];

        $id_province_residence= $cliente->state_residence->province->id;
        $id_state_residence = $cliente->state_residence->id;
        $id_province_shipping= $cliente->state_shipping->province->id;
        $id_state_shipping  = $cliente->state_shipping->id;



        $data['states_residence']   = AdminStates::where('admin_province_id',$id_province_residence)->get();
        $data['states_shipping']    = AdminStates::where('admin_province_id',$id_province_shipping)->get();

        return view('cliente_edit', $data);
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
