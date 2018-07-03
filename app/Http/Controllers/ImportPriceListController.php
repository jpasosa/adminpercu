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



    static function importGope()
    {


        $gopes = DB::table('tmp_gope')->get();

        session(['category' => '']);
        session(['subcategory' => '']);


        foreach ($gopes as $k=>$gope)
        {

            $cat = $gope->precio_cash;

            if ( $cat == 'categoria' || $cat == 'sub' )
            { // es una categoria o una subcategoria

                if ($cat == 'categoria') {
                    session(['category' => $gope->codigo_nombre]);
                    # code...
                } else if ($cat == 'sub') {
                    session(['subcategory' => $gope->codigo_nombre]);
                } else {

                }

            } else {
                // es un instrumento

            $codigo_nombre = trim($gope->codigo_nombre);
            $expl_cod_name = explode("-",$codigo_nombre);

            $producto_gope[$k]['code']  = trim($expl_cod_name[0]);
            $name = trim(str_replace( $producto_gope[$k]['code'], '', $codigo_nombre ));

            $name = trim(substr( $name , 1));

            $producto_gope[$k]['name'] = session('category') . ' ' . session('subcategory') . ' ' . $name;

            $producto_gope[$k]['manufacturer_id'] = 12; // es el id de GOPE

            $producto_gope[$k]['weight']       = '';
            $producto_gope[$k]['dimension']    = '';

            $producto_gope[$k]['list_price']   = $gope->precio_lista;
            $producto_gope[$k]['cash_price']   = trim($gope->precio_cash);
            $producto_gope[$k]['mp_price']     = trim($gope->precio_mp);
            $producto_gope[$k]['ml_price']     = trim($gope->precio_ml);
            $producto_gope[$k]['created_at']   = date('Y-m-d H:i:s');
            $producto_gope[$k]['updated_at']   = date('Y-m-d H:i:s');

            }
        }

        foreach ($producto_gope AS $prod)
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
