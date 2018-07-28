<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProducts extends Model
{

    protected $table = 'admin_products';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'oc_manufacturer_id', 'oc_category_id', 'weight', 'dimension', 'list_price',
        'cash_price', 'mp_price', 'ml_price', 'oc_product_id', 'cash_gain', 'mp_gain', 'ml_gain',
        'popular', 'ml_description', 'oc_description'
    ];


    protected $manufacturer;

    protected $cash_gain;

    protected $mp_gain = 0;

    protected $ml_gain = 0;


    // public getCashGain()
    // {
    //     return  $this->cash_gain;
    // }

    // public setCashGain( $value )
    // {
    //     $this->cash_gain = 1;
    //     return $this->cash_gain;
    // }

    function getManufacturerAttribute()
    {
        if ( $this->oc_manufacturer_id == 17 )
        {
            $response_manufact = 'CONTEMPORANEA';
        } else if ( $this->oc_manufacturer_id == 12 ) {
            $response_manufact = 'GOPE';
        } else if ( $this->oc_manufacturer_id == 11 ) {
            $response_manufact = 'IVSOM';
        } else if ( $this->oc_manufacturer_id == 14 ) {
            $response_manufact = 'KING';
        } else if ( $this->oc_manufacturer_id == 19 ) {
            $response_manufact = 'ROZINI';
        } else if ( $this->oc_manufacturer_id == 18 ) {
            $response_manufact = 'TIMBRA';
        } else {
            $response_manufact = 'Desconocida';
        }

        // dd($response_manufact);

        return $response_manufact;
    }

    function get_manufacturer_text( $id_oc_manufacturer )
    {

        if ( $id_oc_manufacturer == 17 )
        {
            $response_manufact = 'CONTEMPORANEA';
        } else if ( $id_oc_manufacturer == 12 ) {
            $response_manufact = 'GOPE';
        } else if ( $id_oc_manufacturer == 11 ) {
            $response_manufact = 'IVSOM';
        } else if ( $id_oc_manufacturer == 14 ) {
            $response_manufact = 'KING';
        } else if ( $id_oc_manufacturer == 19 ) {
            $response_manufact = 'ROZINI';
        } else if ( $id_oc_manufacturer == 18 ) {
            $response_manufact = 'TIMBRA';
        } else {
            $response_manufact = 'Desconocida';
        }

        // dd($response_manufact);

        return $response_manufact;
    }





}
