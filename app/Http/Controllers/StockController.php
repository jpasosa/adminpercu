<?php

namespace App\Http\Controllers;

use App\Models\AdminStockProducts;
use App\Models\AdminProducts;
use Session;
use Illuminate\Http\Request;

class StockController extends Controller
{


    public function index()
    {

        $data['stock_products'] = AdminStockProducts::all();
        $data['products']       = AdminProducts::all();
        $data['manufacturers']  = AdminProducts::manufacturers_names();

        return view('stock_products', $data);


    }

    public function add_product()
    {

        $validations = [
            'quantity'=> 'required',
            'manufacturer_id'=> 'required',
            'product_id'=> 'required',
            'observations'=> '',
        ];

        $validations_texts = [  'quantity.required' => 'Debe incluir cantidad.',
                                'manufacturer_id.required' => 'Debe especificar marca',
                                'product_id.required' => 'Debe ingresar el producto',
                            ];

        $data = request()->validate($validations, $validations_texts);
        $data_save['quantity']          = $data['quantity'];
        $data_save['admin_product_id']  = $data['product_id'];
        $data_save['observations']      = $data['observations'];


        $product = AdminStockProducts::where('admin_product_id', $data_save['admin_product_id'])->first();

        if (is_null($product))
        {
            // el producto no existe, hay que agregarlo
            $add_products = AdminStockProducts::create($data_save);
        } else {
            // el producto ya está en stock, hay que sumarle la cantidad y sumarle la observación
            $quant_now  = $product->quantity;
            if ($data_save['observations'] == '') {
                unset($data_save['observations']);
            }
            $data_save['quantity'] = $quant_now + $data_save['quantity'];
            $add_products = AdminStockProducts::where('id', $product->id)->update($data_save);
        }



        if ( $add_products ) {
            Session::flash('success_message', 'Agregamos correctamente el/los producto/s');
        } else {
            Session::flash('error_message', 'No se pudo grabar el/los productos. Intente más tarde, gracias!');
        }


        return redirect('stock');



    }


}
