<?php

namespace App\Http\Controllers;

use App\Models\AdminComparsas;
use Illuminate\Http\Request;

use Session;


class ComparsasController extends Controller
{



    public function index()
    {
        $data['comparsas'] = AdminComparsas::all();

        return view('comparsa_list', $data);
    }



    public function add()
    {

        $comparsa_blank = AdminComparsas::get_blank_fields();
        return view('comparsa_add', $comparsa_blank);

    }



    public function add_save_changes()
    {


        $data = request()->validate([
                'name_comparsa' => 'required',
                'name_bateria'  => '',
                'facebook_page' => '',
                'members_cant'  => '',
                'can_publish'   => '',
                'observations'  => '',
                'admin_province_id'=> '',
                'admin_state_id'=> 'required',
            ],[
                'name_comparsa.required' => 'Debe incluir el nombre de la comparsa.',
                'admin_state_id.required' => 'Debe seleccionar una localidad.',
            ]);





        unset($data['admin_province_id']);
        if($data['can_publish'] == '1')  $data['can_publish'] = true;
        if($data['can_publish'] == '0')  $data['can_publish'] = false;



        $save_comparsa = AdminComparsas::create($data);

        if ( $save_comparsa ) {
            Session::flash('success_message', 'Grabamos correctamente la Comparsa');
        } else {
            if ( !Session::has('error_message')) {
                Session::flash('error_message', 'No se pudo grabar la comparsa. Intente más tarde, gracias!');
            }
        }

        return redirect('home');

    }



    public function show ( $id )
    {

        $data['comparsa'] = AdminComparsas::find( $id );

        return view('cliente_ver', $data);

    }




}
