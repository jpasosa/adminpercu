<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminStates extends Model
{


    protected $table = 'admin_states';



    public function province()
    {
        return  $this->belongsTo(AdminProvinces::class, 'admin_province_id');
    }



}
