<?php

namespace App\Http\Controllers;

use App\Models\AdminComparsas;
use Illuminate\Http\Request;

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

        AdminComparsas::create($data);

        return redirect('home');

    }


}
