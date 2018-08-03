<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminOrdersProducts extends Model
{


    protected $table = 'admin_orders_products';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'quantity', 'admin_order_id', 'admin_product_id', 'clarifications','updated_at', 'created_at'
    ];



    public function orders()
    {
        return $this->hasMany(AdminOrders::class, 'admin_order_id');
    }





    public function product()
    {
        return $this->belongsTo( AdminProducts::class, 'admin_product_id');
    }



}
