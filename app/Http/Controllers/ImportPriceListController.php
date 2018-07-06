<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class ImportPriceListController extends Controller
{

    private static function get_categoryOC($name)
    {

        $encontrada = false;
        $categorias = config('categorias');
        $category_id = null;
        $descartar_categoria = false;
        foreach ($categorias AS $cat)
        {

            foreach ($cat['coincide_con'] AS $palabra_coincidente)
            {
                $search = stripos ( $name , $palabra_coincidente);
                if ($search === false) {
                    // no encontro.
                } else {
                    //encontro, define la categoria
                    // ddd('encontro la palabra ' . $palabra_coincidente . ' en nombre instrumento ' . $name);
                    // ddd('Categoria asignación automática . . [OK]');
                    // Command::info('Categoria asignación automática . . [OK] ');

                    foreach ($cat['excluyo_palabras'] AS $palabras_excluidas)
                    {
                        $search = stripos( $name, $palabras_excluidas);
                        if ($search === false)
                        {
                            // no está la palabra excluida
                        } else {
                            // está la palabra excluida
                            $descartar_categoria = true;
                        }
                    }

                    if ($descartar_categoria == false)
                    {
                        $category_id = $cat['id'];
                        $encontrada = true;
                        break;
                    }

                }

            }

            if ($encontrada) { break; }

        }


        return $category_id;


    }


    // ya tenemos la table tml_ivsom y va a importar a la tabla definitiva
    // a la tabla de productos
    static function importIvsom()
    {

        $ivsoms = DB::table('tmp_ivsom')->get();

        foreach ($ivsoms as $k=>$ivsom)
        {
            $price                          = str_replace("$", "", $ivsom->precio_lista);
            $price                          = (int)str_replace(".", "", $price);
            $cash_price                     = calc_cash($price);
            $name                           = trim($ivsom->descripcion);
            $producto_ivsom[$k]['code']     = trim($ivsom->codigo);
            $producto_ivsom[$k]['name']     = $name;
            $producto_ivsom[$k]['oc_manufacturer_id'] = 11; // es el id de ivsom
            $producto_ivsom[$k]['oc_category_id'] = self::get_categoryOC($name);
            $producto_ivsom[$k]['weight']   = trim($ivsom->peso);
            $producto_ivsom[$k]['dimension']= trim($ivsom->medida);
            $producto_ivsom[$k]['list_price']= $price;
            $producto_ivsom[$k]['cash_price']= $cash_price;
            $producto_ivsom[$k]['mp_price'] = calc_mp($cash_price);
            $producto_ivsom[$k]['ml_price'] = calc_ml($cash_price);
            $producto_ivsom[$k]['created_at']= date('Y-m-d H:i:s');
            $producto_ivsom[$k]['updated_at']= date('Y-m-d H:i:s');
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
                $codigo_nombre  = trim($gope->codigo_nombre);
                $expl_cod_name  = explode("-",$codigo_nombre);
                $code           = trim($expl_cod_name[0]);
                $name           = trim(str_replace( $code, '', $codigo_nombre ));
                $name           = trim(substr( $name , 1));
                $name           = session('category') . ' ' . session('subcategory') . ' ' . $name;
                $list_price     = (int)$gope->precio_lista;
                $cash_price     = calc_cash($list_price);
                $producto_gope[$k]['code']          = $code;
                $producto_gope[$k]['name']          = $name;
                $producto_gope[$k]['oc_manufacturer_id']= 12; // es el id de GOPE
                $producto_gope[$k]['oc_category_id'] = self::get_categoryOC($name);
                $producto_gope[$k]['weight']       = '';
                $producto_gope[$k]['dimension']    = '';
                $producto_gope[$k]['list_price']   = $list_price;
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
                $price                              = str_replace("$", "", $king->precio_lista);
                $price                              = str_replace(".", "", $price);
                $price                              = (int)$price;
                $cash_price                         = calc_cash($price);
                $name                               = session('category') . ' ' . $king->nombre . ' ' . $king->pulgadas;
                $producto_king[$k]['code']          = trim($king->codigo);
                $producto_king[$k]['name']          = $name;
                $producto_king[$k]['oc_manufacturer_id'] = 14; // es el id de KING
                $producto_king[$k]['oc_category_id'] = self::get_categoryOC($name);
                $producto_king[$k]['weight']        = '';
                $producto_king[$k]['dimension']     = $king->medidas;
                $producto_king[$k]['list_price']    = $price;
                $producto_king[$k]['cash_price']    = $cash_price;
                $producto_king[$k]['mp_price']      = calc_mp($cash_price);
                $producto_king[$k]['ml_price']      = calc_ml($cash_price);
                $producto_king[$k]['created_at']    = date('Y-m-d H:i:s');
                $producto_king[$k]['updated_at']    = date('Y-m-d H:i:s');

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
            {   // es una categoria o una subcategoria
                session(['category' => trim($timbra->codigo_nombre)]);
            } else {
                // es un instrumento
                $codigo_nombre  = trim($timbra->codigo_nombre);
                $expl_code_name = explode( " ", $codigo_nombre);
                $codigo         = $expl_code_name[0];
                $name_product   = str_replace($codigo, "", $codigo_nombre);
                $name           = session('category') . ' ' . $name_product;
                $price          = str_replace("$", "", $timbra->precio);
                $price          = str_replace(".", "", $price);
                $cash_price     = calc_cash($price);
                $producto_timbra[$k]['code']        = trim($codigo);
                $producto_timbra[$k]['name']        = $name;
                $producto_timbra[$k]['oc_manufacturer_id'] = 18;
                $producto_timbra[$k]['oc_category_id'] = self::get_categoryOC($name);
                $producto_timbra[$k]['weight']       = '';
                $producto_timbra[$k]['dimension']    = '';
                $producto_timbra[$k]['list_price']   = $price;
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
            $price      = str_replace("$", "", $cont->precio);
            $price      = (int)str_replace(".", "", $price);
            $cash_price = calc_cash($price);
            $name       = trim($cont->nombre);
            $producto_contemporanea[$k]['code']         = 'contempo';
            $producto_contemporanea[$k]['name']         = $name;
            $producto_contemporanea[$k]['oc_manufacturer_id'] = 17; // es el id de contemporanea
            $producto_contemporanea[$k]['oc_category_id'] = self::get_categoryOC($name);
            $producto_contemporanea[$k]['weight']       = '';
            $producto_contemporanea[$k]['dimension']    = '';
            $producto_contemporanea[$k]['list_price']   = $price;
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



    static function importRozini()
    {

        $rozinis = DB::table('tmp_rozini')->get();
        session(['category' => '']);

        foreach ($rozinis as $k=>$rozini)
        {

            $cat = $rozini->cat;

            if ( $cat == 'categoria' )
            {   // es una categoria o una subcategoria
                session(['category' => trim($rozini->nombre)]);
            } else {
                // es un instrumento
                $price      = str_replace("$", "", $rozini->precio);
                $price      = str_replace(".", "", $price);
                $cash_price = calc_cash($price);
                $name       = session('category') . ' ' . trim($rozini->nombre);
                $producto_rozini[$k]['code']        = trim($rozini->codigo);;
                $producto_rozini[$k]['name']        = $name;
                $producto_rozini[$k]['oc_manufacturer_id'] = 19;
                $producto_rozini[$k]['oc_category_id'] = self::get_categoryOC($name);
                $producto_rozini[$k]['weight']       = '';
                $producto_rozini[$k]['dimension']    = '';
                $producto_rozini[$k]['list_price']   = $price;
                $producto_rozini[$k]['cash_price']   = $cash_price;
                $producto_rozini[$k]['mp_price']     = calc_mp($cash_price);
                $producto_rozini[$k]['ml_price']     = calc_ml($cash_price);
                $producto_rozini[$k]['created_at']   = date('Y-m-d H:i:s');
                $producto_rozini[$k]['updated_at']   = date('Y-m-d H:i:s');
            }
        }

        foreach ($producto_rozini AS $prod)
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
