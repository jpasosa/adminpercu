<?php

namespace App\Http\Controllers;

use App\Models\AdminComparsas;
use Illuminate\Http\Request;

use Session;


class ComparsasController extends Controller
{



    public function index()
    {

    }



    public function add()
    {
        $comparsa_blank = AdminComparsas::get_blank_fields();

        return view('comparsa_add', $comparsa_blank);
    }



    public function add_save_changes()
    {
        $data = request()->post();

        unset($data['admin_province_id']);
        if($data['can_publish'] == '1')  $data['can_publish'] = true;
        if($data['can_publish'] == '0')  $data['can_publish'] = false;

        if ( $data['name_comparsa'] == '' && $data['name_bateria'] == '')
        {
            Session::flash('error_message', 'Debe ingresar un nombre de Comparsa o de la Bateria al menos.');
            $save_comparsa = false;
        } else {
            $save_comparsa = AdminComparsas::create($data);
        }




        if ( $save_comparsa ) {
            Session::flash('success_message', 'Grabamos correctamente la Comparsa');
        } else {
            if ( !Session::has('error_message')) {
                Session::flash('error_message', 'No se pudo grabar la comparsa. Intente más tarde, gracias!');
            }
        }

        return redirect('home');

    }


}
