<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminOrdersNotes extends Model
{


    protected $table = 'admin_orders_notes';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'note', 'admin_order_id','updated_at', 'created_at'
    ];



    public function orders()
    {
        return $this->hasMany(AdminOrders::class, 'admin_order_id');
    }


}
