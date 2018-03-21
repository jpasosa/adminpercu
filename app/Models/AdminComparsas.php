<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdminProvinces;
use App\Models\AdminStates;

class AdminComparsas extends Model
{


    protected $table = 'admin_comparsas';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_comparsa', 'name_bateria', 'admin_state_id', 'facebook_page', 'members_cant', 'can_publish', 'observations'
    ];



    static function get_blank_fields()
    {


        $provinces  = AdminProvinces::all()->sortBy('name');
        $states     = AdminStates::all()->where('admin_province_id',1)->sortBy('name');

        return [
            'admin_state_id' => $states,
            'admin_province_id' => $provinces,
        ];
    }

    public function state()
    {
        return  $this->belongsTo(AdminStates::class, 'admin_state_id');
    }

}



