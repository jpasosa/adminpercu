<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminStockProducts extends Model
{
     protected $table = 'admin_stock_products';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'quantity', 'admin_product_id', 'observations', 'updated_at', 'created_at'
    ];



    public function product()
    {
        return $this->belongsTo( AdminProducts::class, 'admin_product_id');
    }
}
