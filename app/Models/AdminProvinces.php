<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProvinces extends Model
{


    protected $table = 'admin_provinces';







    function states()
    {

        return $this->hasMany(AdminStates::class, 'admin_province_id')->orderBy('name');

    }


}
