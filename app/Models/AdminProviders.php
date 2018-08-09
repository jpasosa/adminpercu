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


    public function view_hover_products()
    {
        $id         = $this->attributes['id'];
        $products   = DB::table('admin_providers_products')
                            ->where('admin_providers_products.admin_provider_id', $id)
                            ->join('admin_products', 'admin_providers_products.admin_product_id', '=', 'admin_products.id')
                            ->get();

        $hover = '';
        foreach ($products AS $prod)
        {
            $hover .= '** - ' . $prod->quantity . 'x - ' . $this->get_manufacturer_text($prod->oc_manufacturer_id) . ' - ' . $prod->name . '---------&#10;';
        }

        return $hover;
    }

    private function get_manufacturer_text( $id_oc_manufacturer )
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

    static function get_next_number()
    {
        // asigno el número.
        $order = DB::table('admin_providers')
                            ->orderBy('id','desc')
                            ->limit(1)
                            ->get();
        return $order[0]->number + 1;

    }


}
