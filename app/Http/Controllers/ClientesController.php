<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\AdminComparsas;
use App\Models\AdminClients;
use Session;

class ClientesController extends Controller
{


    public function index()
    {

    }



    public function add()
    {
        $clients_blank = AdminClients::get_blank_fields();

        return view('cliente_add', $clients_blank);
    }



    public function add_save_changes()
    {
        $data = request()->post();

        if($data['friends'] == '1')  $data['friends'] = true;
        if($data['friends'] == '0')  $data['friends'] = false;

        if ( $data['dni'] == '' && $data['name'] == '')
        {
            Session::flash('error_message', 'Debe ingresar su nombre y su DNI.');
            $save_client = false;
        } else {
            $save_client = AdminClients::create($data);
        }




        if ( $save_client ) {
            Session::flash('success_message', 'Grabamos correctamente el nuevo cliente');
        } else {
            if ( !Session::has('error_message')) {
                Session::flash('error_message', 'No se pudo grabar el cliente. Intente más tarde, gracias!');
            }
        }

        return redirect('home');

    }


}

