<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class ImportPriceListController extends Controller
{


    // ya tenemos la table tml_ivsom y va a importar a la tabla definitiva
    // a la tabla de productos
    static function importIvsom()
    {


        $ivsoms = DB::table('tmp_ivsom')->get();


        foreach ($ivsoms as $k=>$ivsom)
        {
            $producto_ivsom[$k]['code']         = trim($ivsom->codigo);
            $producto_ivsom[$k]['name']         = trim($ivsom->descripcion);
            $producto_ivsom[$k]['manufacturer_id'] = 11; // es el id de ivsom
            $producto_ivsom[$k]['weight']       = trim($ivsom->peso);
            $producto_ivsom[$k]['dimension']    = trim($ivsom->medida);
            $price = str_replace("$", "", $ivsom->precio_lista);
            $price = str_replace(".", "", $price);
            $producto_ivsom[$k]['list_price']   = $price;
            $producto_ivsom[$k]['cash_price']   = trim($ivsom->precio_cash);
            $producto_ivsom[$k]['mp_price']     = trim($ivsom->precio_mp);
            $producto_ivsom[$k]['ml_price']     = trim($ivsom->precio_ml);
            $producto_ivsom[$k]['created_at']   = date('Y-m-d H:i:s');
            $producto_ivsom[$k]['updated_at']   = date('Y-m-d H:i:s');
        }


        foreach ($producto_ivsom AS $prod)
        {
            $insert_product = DB::table('admin_products')->insert($prod);
        }

        if ($insert_product) {
            return true;
        } else {
            return false;
        }

    }





}
