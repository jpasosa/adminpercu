<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminQuotationsProducts extends Model
{


     protected $table = 'admin_quotations_products';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'quantity', 'admin_quotation_id', 'admin_product_id', 'clarifications','updated_at', 'created_at'
    ];



    public function quotations()
    {
        return $this->hasMany(AdminQuotations::class);
    }

    public function product()
    {
        return $this->belongsTo( AdminProducts::class, 'admin_product_id');
    }






}
