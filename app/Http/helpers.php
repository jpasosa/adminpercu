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

