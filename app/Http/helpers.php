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