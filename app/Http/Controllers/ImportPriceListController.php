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
            $price = (int)str_replace(".", "", $price);
            $producto_ivsom[$k]['list_price']   = $price;
            $cash_price = calc_cash($price);
            $producto_ivsom[$k]['cash_price']   = $cash_price;
            $producto_ivsom[$k]['mp_price']     = calc_mp($cash_price);
            $producto_ivsom[$k]['ml_price']     = calc_ml($cash_price);
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

            $list_price = (int)$gope->precio_lista;
            $producto_gope[$k]['list_price']   = $list_price;
            $cash_price = calc_cash($list_price);
            $producto_gope[$k]['cash_price']   = $cash_price;
            $producto_gope[$k]['mp_price']     = calc_mp($cash_price);
            $producto_gope[$k]['ml_price']     = calc_ml($cash_price);
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






    static function importKing()
    {


        $kings = DB::table('tmp_king')->get();

        session(['category' => '']);


        foreach ($kings as $k=>$king)
        {

            $cat = $king->precio_cash;

            if ( $cat == 'categoria' )
            { // es una categoria o una subcategoria

                session(['category' => $king->codigo]);


            } else {
                // es un instrumento

            $producto_king[$k]['code']  = trim($king->codigo);
            $producto_king[$k]['name'] = session('category') . ' ' . $king->nombre . ' ' . $king->pulgadas;

            $producto_king[$k]['manufacturer_id'] = 14; // es el id de KING

            $producto_king[$k]['weight']       = '';
            $producto_king[$k]['dimension']    = $king->medidas;


            $price = str_replace("$", "", $king->precio_lista);
            $price = str_replace(".", "", $price);
            (int)$price;




            $producto_king[$k]['list_price']   = $price;
            $cash_price = calc_cash($price);
            $producto_king[$k]['cash_price']   = $cash_price;
            $producto_king[$k]['mp_price']     = calc_mp($cash_price);
            $producto_king[$k]['ml_price']     = calc_ml($cash_price);
            $producto_king[$k]['created_at']   = date('Y-m-d H:i:s');
            $producto_king[$k]['updated_at']   = date('Y-m-d H:i:s');

            }
        }

        foreach ($producto_king AS $prod)
        {
            $insert_product = DB::table('admin_products')->insert($prod);
        }

        if ($insert_product) {
            return true;
        } else {
            return false;
        }

    }





     static function importTimbra()
    {


        $timbras = DB::table('tmp_timbra')->get();

        session(['category' => '']);


        foreach ($timbras as $k=>$timbra)
        {

            $cat = $timbra->cat;

            if ( $cat == 'categoria' )
            { // es una categoria o una subcategoria

                session(['category' => trim($timbra->codigo_nombre)]);


            } else {
                // es un instrumento

            $codigo_nombre = trim($timbra->codigo_nombre);
            $expl_code_name = explode( " ", $codigo_nombre);
            $codigo = $expl_code_name[0];
            $producto_timbra[$k]['code']  = trim($codigo);
            $name_product = str_replace($codigo, "", $codigo_nombre);
            $producto_timbra[$k]['name'] = session('category') . ' ' . $name_product;


            $producto_timbra[$k]['manufacturer_id'] = 18; // falta agregar la marca timbra en la tienda

            $producto_timbra[$k]['weight']       = '';
            $producto_timbra[$k]['dimension']    = '';


            $price = str_replace("$", "", $timbra->precio);
            $price = str_replace(".", "", $price);
            $producto_timbra[$k]['list_price']   = $price;
            $cash_price = calc_cash($price);
            $producto_timbra[$k]['cash_price']   = $cash_price;
            $producto_timbra[$k]['mp_price']     = calc_mp($cash_price);
            $producto_timbra[$k]['ml_price']     = calc_ml($cash_price);
            $producto_timbra[$k]['created_at']   = date('Y-m-d H:i:s');
            $producto_timbra[$k]['updated_at']   = date('Y-m-d H:i:s');

            }
        }

        foreach ($producto_timbra AS $prod)
        {
            $insert_product = DB::table('admin_products')->insert($prod);
        }

        if ($insert_product) {
            return true;
        } else {
            return false;
        }

    }

    static function importContemporanea()
    {

        $contemporaneas = DB::table('tmp_contemporanea')->get();


        foreach ($contemporaneas as $k=>$cont)
        {
            $producto_contemporanea[$k]['code']         = 'contempo';
            $producto_contemporanea[$k]['name']         = trim($cont->nombre);
            $producto_contemporanea[$k]['manufacturer_id'] = 17; // es el id de contemporanea
            $producto_contemporanea[$k]['weight']       = '';
            $producto_contemporanea[$k]['dimension']    = '';
            $price = str_replace("$", "", $cont->precio);
            $price = (int)str_replace(".", "", $price);
            $producto_contemporanea[$k]['list_price']   = $price;
            $cash_price = calc_cash($price);
            $producto_contemporanea[$k]['cash_price']   = $cash_price;
            $producto_contemporanea[$k]['mp_price']     = calc_mp($cash_price);
            $producto_contemporanea[$k]['ml_price']     = calc_ml($cash_price);
            $producto_contemporanea[$k]['created_at']   = date('Y-m-d H:i:s');
            $producto_contemporanea[$k]['updated_at']   = date('Y-m-d H:i:s');
        }


        foreach ($producto_contemporanea AS $prod)
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