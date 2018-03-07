<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminClients extends Model
{

     protected $table = 'admin_clients';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 'last_name', 'user_ml', 'email', 'dni', 'phone', 'face', 'friends', 'admin_state_residence_id',
            'admin_state_shipping_id', 'admin_comparsas_id', 'observations'
    ];



    static function get_blank_fields()
    {


        $provinces  = AdminProvinces::all()->pluck('name', 'id');
        $states     = AdminStates::all()->where('admin_province_id',1)->sortBy('name');
        $comparsas  = AdminComparsas::all()->toArray();


        return [
            'name'  => '',
            'last_name'  => '',
            'user_ml'  => '',
            'email'  => '',
            'dni'  => '',
            'phone'  => '',
            'face'  => '',
            'friends'  => false,
            'last_name'  => '',
            'last_name'  => '',
            'last_name'  => '',
            'last_name'  => '',
            'last_name'  => '',
            'last_name'  => '',
            'admin_state_residence_id' => $states,
            'admin_province_residence_id' => $provinces,
            'admin_state_shipping_id' => $states,
            'admin_province_shipping_id' => $provinces,
            'admin_comparsas_id' => $comparsas,
            'observations' => '',
        ];
    }

    public function state_residence()
    {
        return  $this->belongsTo(AdminStates::class, 'admin_state_residence_id');
    }

    public function state_shipping()
    {
        return  $this->belongsTo(AdminStates::class, 'admin_state_shipping_id');
    }

    public function comparsa()
    {
        return  $this->belongsTo(AdminComparsas::class, 'admin_comparsas_id');
    }




}
