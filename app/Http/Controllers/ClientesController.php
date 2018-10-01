<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminComparsas;
use App\Models\AdminClients;
use App\Models\AdminStates;
use Session;
use Illuminate\Support\Facades\DB;



class ClientesController extends Controller
{




    public function index()
    {

        $data['clients'] = AdminClients::orderBy('id', 'desc')->paginate(30);

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

        $validations = [
                'name'          => 'required',
                'last_name'     => '',
                'user_ml'       => '',
                'user_whatsapp' => '',
                'email'         => '',
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

            ];

        if (!is_null(request('dni'))) {
            $validations['dni'] = 'unique:admin_clients';
        }

        $data = request()->validate($validations);


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






    public function edit( $id )
    {

        $data['cliente']    = AdminClients::find( $id );
        $cliente            = $data['cliente'];


        $id_province_residence= $cliente->state_residence->province->id;
        $id_state_residence = $cliente->state_residence->id;
        $id_province_shipping= $cliente->state_shipping->province->id;
        $id_state_shipping  = $cliente->state_shipping->id;

        $data['states_residence']   = AdminStates::where('admin_province_id',$id_province_residence)->orderBy('name')->get();
        $data['states_shipping']    = AdminStates::where('admin_province_id',$id_province_shipping)->orderBy('name')->get();

        $data['admin_comparsas_id'] = AdminComparsas::all();

        return view('cliente_edit', $data);
    }

    public function edit_save_changes( $id )
    {

        $validations = [
                'name'          => 'required',
                'last_name'     => '',
                'user_ml'       => '',
                'user_whatsapp' => '',
                'email'         => '',
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

            ];

        if (!is_null(request('dni'))) {
            $validations['dni'] = 'unique:admin_clients';
        }

        $data = request()->validate($validations);


        if($data['friends'] == '1')     $data['friends']= true;
        if($data['friends'] == '0')     $data['friends']= false;
        if($data['user_ml'] == '')      $data['user_ml']= null;
        if($data['face'] == '')         $data['face']   = null;
        if($data['email'] == null)      $data['email']  = '';
        if($data['admin_comparsas_id'] == 'null')   $data['admin_comparsas_id'] = null;

        unset($data['admin_province_residence_id'], $data['admin_province_shipping_id']);

        $update = AdminClients::where('id', $id)
                    ->update($data);

        if ( $update ) {
            Session::flash('success_message', 'Editamos correctamente el cliente');
        } else {
            if ( !Session::has('error_message')) {
                Session::flash('error_message', 'No se pudo actualizar el cliente. Intente más tarde, gracias!');
            }
        }

        return redirect('home');

    }










}

