<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreciosController extends Controller
{




    function get_prices()
    {
        return view('get_prices');
    }

    public function calcular_precios()
    {

        $data = request()->post();

        $price      = $data['price'];
        $discount   = $data['discount'];

        $real_price = $price * saco_porc($discount);


        if ($real_price > 0 && $real_price < 301)
            $indice_aumento = 1.7;
        else if ( $real_price > 300 && $real_price < 601 )
            $indice_aumento = 1.6;
        else if ( $real_price > 600 && $real_price < 901 )
            $indice_aumento = 1.37;
        else if ( $real_price > 900 && $real_price < 1501 )
            $indice_aumento = 1.30;
        else if ( $real_price > 1500 && $real_price < 2001 )
            $indice_aumento = 1.28;
        else if ( $real_price > 2000 && $real_price < 2501 )
            $indice_aumento = 1.26;
        else if ( $real_price > 2500 && $real_price < 3001 )
            $indice_aumento = 1.24;
        else if ( $real_price > 3000 && $real_price < 20000 )
            $indice_aumento = 1.22;
        else
            $indice_aumento = 0;


        $precio_venta_cash          = $real_price * $indice_aumento;
        $prices['cash']['sugerido'] = $precio_venta_cash;
        $prices['cash']['real']     = $precio_venta_cash;
        $prices['cash']['ganancia'] = $precio_venta_cash - $real_price;

        $precio_venta_MP            = $real_price * $indice_aumento * sumo_porc(config('indices.gan_mia_por_MP'));
        $prices['MP']['sugerido']   = $precio_venta_MP;
        $prices['MP']['real']       = $precio_venta_MP;
        $prices['MP']['ganancia']   = $precio_venta_MP * saco_porc( config('indices.gan_por_MP') ) - $real_price ;

        $precio_venta_ML            = $real_price * $indice_aumento * sumo_porc( config('indices.gan_mia_por_ML'));
        $prices['ML']['sugerido']   = $precio_venta_ML;
        $prices['ML']['real']       = $precio_venta_ML;
        $prices['ML']['ganancia']   = $precio_venta_ML * saco_porc( config('indices.gan_por_ML')) - $real_price;


        return view('show_prices', ['prices' => $prices]);




        // dd($data);
    }

    public function recalcular_precios()
    {
        $data = request()->post();

        $prices['cash']['sugerido'] = $data['cash_sugerido'];
        $prices['cash']['real']     = $data['cash_real'];
        $prices['cash']['ganancia'] = $data['cash_ganancia'] - ( $data['cash_real_anterior'] - $data['cash_real'] ) ;

        $prices['MP']['sugerido']   = $data['mp_sugerido'];
        $prices['MP']['real']       = $data['mp_real'];
        $prices['MP']['ganancia']   = $data['mp_ganancia'] - ( $data['mp_real_anterior'] - $data['mp_real'] ) ;

        $prices['ML']['sugerido']   = $data['ml_sugerido'];
        $prices['ML']['real']       = $data['ml_real'];
        $prices['ML']['ganancia']   = $data['ml_ganancia'] - ( $data['ml_real_anterior'] - $data['ml_real'] ) ;


        return view('show_prices', ['prices' => $prices]);



    }
}
