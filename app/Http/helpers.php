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
            $indice_aumento = 1.40;
        else if ( $real_price > 300 && $real_price < 601 )
            $indice_aumento = 1.35;
        else if ( $real_price > 600 && $real_price < 901 )
            $indice_aumento = 1.33;
        else if ( $real_price > 900 && $real_price < 1501 )
            $indice_aumento = 1.30;
        else if ( $real_price > 1500 && $real_price < 2001 )
            $indice_aumento = 1.27;
        else if ( $real_price > 2000 && $real_price < 2501 )
            $indice_aumento = 1.24;
        else if ( $real_price > 2500 && $real_price < 3001 )
            $indice_aumento = 1.23;
        else if ( $real_price > 3000 && $real_price < 4001 )
            $indice_aumento = 1.22;
        else if ( $real_price > 4000 && $real_price < 5001 )
            $indice_aumento = 1.21;
        else if ( $real_price > 5000 && $real_price < 30000 )
            $indice_aumento = 1.20;
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
        $mp = (float)$price_cash * 1.10;
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
        $ml = (float)$price_cash * 1.15;
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



if ( ! function_exists('calculate_busines_days'))
{
    function calculate_busines_days($begin_date, $end_date, $type = 'array')
    {
        $date_1 = date_create($begin_date);
        $date_2 = date_create($end_date);
        if ($date_1 > $date_2) return FALSE;
        $bussiness_days = array();
        while ($date_1 <= $date_2) {
            $day_week = $date_1->format('w');
            if ($day_week > 0 && $day_week < 6) {
                $bussiness_days[$date_1->format('Y-m')][] = $date_1->format('d');
            }
            date_add($date_1, date_interval_create_from_date_string('1 day'));
        }
        if (strtolower($type) === 'sum') {
            array_map(function($k) use(&$bussiness_days) {
                $bussiness_days[$k] = count($bussiness_days[$k]);
            }, array_keys($bussiness_days));
        }

        // paso directamente la cantidad de días.
        if (is_array($bussiness_days))
        {
            $days = 0;
            foreach ($bussiness_days AS $k => $bsd)
            {
                if (is_array($bsd))
                {
                    $days += count($bsd);
                }
            }
        }

        return $days;
    }

}





