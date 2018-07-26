<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;



class AdminQuotations extends Model
{



    protected $table = 'admin_quotations';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'description', 'admin_client_id', 'number', 'price_mp_fixed', 'price_cash_fixed','updated_at', 'created_at'
    ];

    protected $appends = [
        'cantItems'
    ];

    // protected $titulo = '';


    static function get_blank_fields()
    {


        $clients    = AdminClients::all()->toArray();

        return [
            'admin_clients' => $clients,
        ];
    }


    public function getCantItemsAttribute()
    {

        $id = $this->attributes['id'];

        $products = DB::table('admin_quotations_products')->where('admin_quotation_id', $id)->count();


        return $products;
    }

    public function getTotalAttribute()
    {

        $id         = $this->attributes['id'];
        $products   = DB::table('admin_quotations_products')
                            ->where('admin_quotations_products.admin_quotation_id', $id)
                            ->join('admin_products', 'admin_quotations_products.admin_product_id', '=', 'admin_products.id')
                            ->sum('admin_products.cash_price');

        return $products;

    }







    public function client()
    {
        return  $this->belongsTo(AdminClients::class, 'admin_client_id');
    }





}
