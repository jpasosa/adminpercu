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




    protected $cash_gain;

    protected $mp_gain = 0;

    protected $ml_gain = 0;


    public getCashGain()
    {
        return  $this->cash_gain;
    }

    public setCashGain( $value )
    {
        $this->cash_gain = 1;
        return $this->cash_gain;
    }



}
