<?php


if ( ! function_exists('sumo_porc'))
{
    function sumo_porc( $porcentaje )
    {
        return ( 1 + ($porcentaje * 0.01) );
    }
}

if ( ! function_exists('saco_porc'))
{
    function saco_porc( $porcentaje )
    {
        return ( 1 - ($porcentaje * 0.01) );
    }
}

if ( ! function_exists('ddd'))
{
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function ddd($v, $asString = false)
    {
        if (!$asString) {
            array_map(function ($x) {
                (new Illuminate\Support\Debug\Dumper)->dump($x);
            }, [$v]);
        } else {
            $r = array_map(function ($x) {
                return (new App\Library\Classes\Dumper)->dump($x);
            }, [$v]);
            return $r[0];
        }
    }
}


if ( ! function_exists('calc_cash'))
{
    function calc_cash( $price_list )
    {
        $real_price = (float)$price_list * (1 - ( config('indices.desc_lista') * 0.01 ));
        if ($real_price > 0 && $real_price < 301)
            $indice_aumento = 1.44;
        else if ( $real_price > 300 && $real_price < 601 )
            $indice_aumento = 1.38;
        else if ( $real_price > 600 && $real_price < 901 )
            $indice_aumento = 1.37;
        else if ( $real_price > 900 && $real_price < 1501 )
            $indice_aumento = 1.30;
        else if ( $real_price > 1500 && $real_price < 2001 )
            $indice_aumento = 1.29;
        else if ( $real_price > 2000 && $real_price < 2501 )
            $indice_aumento = 1.28;
        else if ( $real_price > 2500 && $real_price < 3001 )
            $indice_aumento = 1.27;
        else if ( $real_price > 3000 && $real_price < 20000 )
            $indice_aumento = 1.26;
        else
            $indice_aumento = 0;


        $precio_venta_cash  = $real_price * $indice_aumento;
        $precio_venta_cash  = (int)$precio_venta_cash;
        $new_pv_cash        = substr_replace($precio_venta_cash , "",-1);
        $new_pv_cash        = $new_pv_cash . '0';
        $new_pv_cash        = (int)$new_pv_cash;

        return $new_pv_cash;
    }
}

if ( ! function_exists('calc_mp'))
{
    function calc_mp( $price_cash )
    {
        $mp = (float)$price_cash * 1.08;
        $mp = (int)$mp;
        $new_mp = substr_replace($mp ,"",-1);
        $new_mp = $new_mp . '0';
        $new_mp = (int)$new_mp;

        return $new_mp;
    }
}

if ( ! function_exists('calc_ml'))
{
    function calc_ml( $price_cash )
    {
        $ml = (float)$price_cash * 1.13;
        $ml = (int)$ml;
        $new_ml = substr_replace($ml ,"",-1);
        $new_ml = $new_ml . '0';
        $new_ml = (int)$new_ml;
        return $new_ml;
    }
}


if ( ! function_exists('calc_gain_cash'))
{
    function calc_gain_cash( $list_price )
    {
        $price_cash     = calc_cash($list_price);
        $price_descount = (float)$list_price * (1 - ( config('indices.desc_lista') * 0.01 ));
        $gain           = $price_cash - $price_descount;
        $gain           = (int)$gain;
        return $gain;
    }
}

if ( ! function_exists('calc_gain_mp'))
{
    function calc_gain_mp( $list_price )
    {
        $price_cash     = calc_cash($list_price);
        $price_descount = (float)$list_price * (1 - ( config('indices.desc_lista') * 0.01 ));
        $price_mp       = calc_mp($price_cash);
        $desc_mp        = $price_mp * (1 - ( config('indices.gan_por_MP') * 0.01 ) );
        $gain           = $desc_mp - $price_descount;
        return $gain;
    }
}

if ( ! function_exists('calc_gain_ml'))
{
    function calc_gain_ml( $list_price )
    {
        $price_cash     = calc_cash($list_price);
        $price_descount = (float)$list_price * (1 - ( config('indices.desc_lista') * 0.01 ));
        $price_ml       = calc_ml($price_cash);
        $desc_ml        = $price_ml * (1 - ( config('indices.gan_por_ML') * 0.01 ) );
        $gain           = $desc_ml - $price_descount;
        return $gain;
    }
}



if ( ! function_exists('convert_date'))
{
    function convert_date( $date_in )
    {
        if ($date_in != '') {
            $date_explode   = explode('/', $date_in);
            return $date_explode[2] . '-' . $date_explode[0] . '-' . $date_explode[1];
        } else {
            return null;
        }
    }
}

