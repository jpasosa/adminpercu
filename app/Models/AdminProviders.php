<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class AdminProviders extends Model
{



    protected $table = 'admin_providers';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'number', 'price_total', 'price_discount', 'price_fixed', 'description','updated_at', 'created_at'
    ];

    protected $appends = [
        'cantItems'
    ];

    protected $dates = ['date_aboned', 'date_arrived'];

    // protected $titulo = '';


    // static function get_blank_fields()
    // {


    //     $clients    = AdminClients::all()->toArray();

    //     return [
    //         'admin_clients' => $clients,
    //     ];
    // }


    public function getCantItemsAttribute()
    {

        $id = $this->attributes['id'];

        $products = DB::table('admin_providers_products')->where('admin_provider_id', $id)->count();


        return $products;
    }

    public function getTotalAttribute()
    {

        $id         = $this->attributes['id'];
        $products   = DB::table('admin_providers_products')
                            ->where('admin_providers_products.admin_provider_id', $id)
                            ->join('admin_products', 'admin_providers_products.admin_product_id', '=', 'admin_products.id')
                            ->sum('admin_products.cash_price');

        return $products;

    }

    static function getStatus()
    {
        return [    1=>'pedido-a-fabrica-brasil',
                    2=>'salio-fabrica-viaje-frontera',
                    3=>'en-frontera',
                    4=>'viajando-caseros',
                    5=>'viajando-catamarca',
                    6=>'para-retirar',
                    7=>'retirados',
                ];
    }

    public function getDaysPassedAttribute()
    {

        if (!is_null($this->date_aboned))
        {
            if (is_null($this->date_arrived)) {
                $days = calculate_busines_days( $this->date_aboned->format('Y-m-d'), date('Y-m-d'));
            } else {
                $days = calculate_busines_days( $this->date_aboned->format('Y-m-d'), $this->date_arrived->format('Y-m-d'));
            }
        } else {
            $days = 'sin dato';
        }

        return $days;

    }






}
