<?php

namespace App\Http\Controllers;

use App\Models\AdminComparsas;
use App\Models\AdminStates;
use Illuminate\Http\Request;

use Session;


class ComparsasController extends Controller
{



    public function index()
    {
        $data['comparsas'] = AdminComparsas::orderBy('name_comparsa')->paginate(30);

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

    public function edit( $id )
    {

        $data['comparsa'] = AdminComparsas::find( $id );

        $comparsa = $data['comparsa'];




        $id_province = $comparsa->state->province->id;
        $id_state   = $comparsa->state->id;

        $data['states']     = AdminStates::where('admin_province_id',$id_province)->get();



        return view('comparsa_edit', $data);
    }

    public function edit_save_changes( $id )
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

        $save = AdminComparsas::where('id', $id)
                    ->update($data);

        if ( $save ) {
            Session::flash('success_message', 'Editamos correctamente la Comparsa');
        } else {
            if ( !Session::has('error_message')) {
                Session::flash('error_message', 'No se pudo actualizar la comparsa. Intente más tarde, gracias!');
            }
        }

        return redirect('home');

    }


    public function show ( $id )
    {

        $data['comparsa'] = AdminComparsas::find( $id );

        return view('comparsa_show', $data);

    }




}
