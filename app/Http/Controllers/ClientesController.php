<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\AdminComparsas;
use App\Models\AdminClients;
use Session;
use Illuminate\Support\Facades\DB;



class ClientesController extends Controller
{




    public function index()
    {

        $data['clients'] = AdminClients::all();

        return view('cliente_lista', $data);

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
        $clients_blank = AdminClients::get_blank_fields();


        return view('cliente_add', $clients_blank);
    }




    public function add_save_changes()
    {


        $data = request()->validate([
                'name'          => 'required',
                'last_name'     => '',
                'user_ml'       => '',
                'email'         => '',
                'dni'           => 'required|unique:admin_clients',
                'phone'         => '',
                'marketing'     => '',
                'face'          => '',
                'friends'       => '',
                'admin_province_residence_id'=> '',
                'admin_state_residence_id'  => '',
                'admin_province_shipping_id'=> '',
                'admin_state_shipping_id'=> '',
                'admin_comparsas_id'    => '',
                'observations'          => '',

            ]);


        if($data['friends'] == '1')     $data['friends']= true;
        if($data['friends'] == '0')     $data['friends']= false;
        if($data['user_ml'] == '')      $data['user_ml']= null;
        if($data['face'] == '')         $data['face']   = null;
        if($data['email'] == null)      $data['email']  = '';
        if($data['admin_comparsas_id'] == 'null')   $data['admin_comparsas_id'] = null;



        $save_client = AdminClients::create($data);

        if ( $save_client ) {
            Session::flash('success_message', 'Grabamos correctamente el nuevo cliente');
        } else {
            Session::flash('error_message', 'No se pudo grabar el cliente. Intente más tarde, gracias!');
        }


        return redirect('clientes');

    }


}

