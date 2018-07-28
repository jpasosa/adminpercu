<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class AdminOrders extends Model
{


    protected $table = 'admin_orders';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'number', 'admin_client_id', 'total_cash', 'total_mp', 'total_ml', 'total_cash_fixed', 'total_mp_fixed', 'total_ml_fixed','updated_at', 'created_at',
            'abonado_cash', 'abonado_mp', 'abonado_ml', 'idcobro_mp', 'idcobro_ml', 'date_cash', 'date_mp', 'date_ml',
            'date_send', 'empresa_send', 'codetrack_send', 'cash_send', 'observations', 'status'
    ];

    protected $totalCash;


    public function getTotalCashAttribute()
    {
        $id         = $this->attributes['id'];
        $products   = DB::table('admin_orders_products')
                            ->where('admin_orders_products.admin_order_id', $id)
                            ->join('admin_products', 'admin_orders_products.admin_product_id', '=', 'admin_products.id')
                            ->sum('admin_products.cash_price');

        return $products;

    }

    public function setTotalCashAttribute()
    {

        $this->totalCash = $this->getTotalCashAttribute();
    }

     public function client()
    {
        return  $this->belongsTo(AdminClients::class, 'admin_client_id');
    }

    public function getCantItemsAttribute()
    {

        $id = $this->attributes['id'];

        $products = DB::table('admin_orders_products')->where('admin_order_id', $id)->count();


        return $products;
    }

    public function view_hover_products()
    {
        $id         = $this->attributes['id'];
        $products   = DB::table('admin_orders_products')
                            ->where('admin_orders_products.admin_order_id', $id)
                            ->join('admin_products', 'admin_orders_products.admin_product_id', '=', 'admin_products.id')
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

}
