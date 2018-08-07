<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminProviders;
use App\Models\AdminProvidersProducts;
use App\Models\AdminProducts;
use Session;

class ProveedoresController extends Controller
{


    public function index()
    {

        $providers         = AdminProviders::orderBy('id', 'desc')->paginate();

        $data['providers'] = $providers;
        return view('proveedores_list', $data);



    }

     public function edit( $id )
    {

        $data['provider']= AdminProviders::find( $id );

        $data['providers_products'] = AdminProvidersProducts::where('admin_provider_id', $id)->get();

        $data['manufacturers']  = [ 17 => 'CONTEMPORANEA',
                                    12 => 'GOPE',
                                    11 => 'IVSOM',
                                    14 => 'KING',
                                    19 => 'ROZINI',
                                    18 => 'TIMBRA',
                                ];
        $data['products']       = AdminProducts::all();

        $data['status']         = AdminProviders::getStatus();


        return view('proveedor_edit', $data);
    }

     public function edit_add_product ()
    {



        $validations = [
            'admin_provider_id' => 'required',
            'quantity'=> 'required',
            'manufacturer_id'=> 'required',
            'product_id'=> 'required',
            'aclarations'=> '',
        ];

        $validations_texts = [  'admin_provider_id' => 'Se produjo un error, volver a cargar la página por favor!',
                                'quantity.required' => 'Debe incluir cantidad.',
                                'manufacturer_id.required' => 'Debe especificar marca',
                                'product_id.required' => 'Debe ingresar el producto',
                            ];




        $data = request()->validate($validations, $validations_texts);

        $data['admin_product_id'] = $data['product_id'];
        unset($data['manufacturer_id'], $data['product_id']);
        $product = AdminProducts::find($data['admin_product_id']);
        $data['list_price']     = $product->list_price;
        $data['subt_price']     = $product->list_price * $data['quantity'];
        $data['discount_price'] = $data['subt_price'] * 0.2;
        $data['total_price']    = $data['subt_price'] - $data['discount_price'] ;

        $save_provider_product = AdminProvidersProducts::create($data);

        if ( $save_provider_product ) {
            Session::flash('success_message', 'Agregamos correctamente el producto');
        } else {
            Session::flash('error_message', 'No se pudo grabar el producto. Intente más tarde, gracias!');
        }


        return redirect('proveedor/editar/' . $data['admin_provider_id']);



    }


    public function edit_add_data()
    {
        $validations = [
                'admin_provider_id' => 'required',
                'date_aboned'       => 'nullable|date|date_format:m/d/Y',
                'date_arrived'       => 'nullable|date|date_format:m/d/Y',
                'price_fixed'       => 'nullable|numeric',
                'description'       => 'nullable',
                'status'            => 'nullable',
            ];

        $validations_texts = [  'admin_provider_id'     => 'Se produjo un error, volver a cargar la página por favor!',
                                'date_aboned.date'      => 'Debe ingresar una fecha.',
                                'date_aboned.date_format'=> 'Esta mal el formato de la fecha.',
                                'date_arrived.date'      => 'Debe ingresar una fecha.',
                                'date_arrived.date_format'=> 'Esta mal el formato de la fecha.',
                                'price_fixed.numeric'   => 'El importe debe ser numerico.',
                                'description'           => '',
                                'status.required'       => 'Debe agregar el estado',
                            ];




        $data = request()->validate($validations, $validations_texts);


        $id     = $data['admin_provider_id'];

        unset($data['admin_provider_id'], $data['_token']);

        $data['date_aboned']  = convert_date($data['date_aboned']);
        $data['date_arrived']  = convert_date($data['date_arrived']);

        $update = AdminProviders::where('id', $id)
                                ->update( $data );




        if ( $update ) {
            Session::flash('success_message', 'Agregamos los datos correctamente');
        } else {
            Session::flash('error_message', 'No se pudo agregar los datos. Intente más tarde, gracias!');
        }

        return redirect('proveedor/editar/' . $id);

        // dd($update);
    }




}
