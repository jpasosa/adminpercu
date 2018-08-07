<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProvidersProducts extends Model
{
     protected $table = 'admin_providers_products';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'quantity', 'admin_provider_id', 'admin_product_id', 'clarifications', 'list_price', 'subt_price', 'discount_price', 'total_price', 'updated_at', 'created_at'
    ];



    public function providers()
    {
        return $this->hasMany(AdminProviders::class);
    }

    public function product()
    {
        return $this->belongsTo( AdminProducts::class, 'admin_product_id');
    }


}
