<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminClients extends Model
{

     protected $table = 'admin_clients';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 'last_name', 'user_ml', 'user_whatsapp', 'email', 'marketing', 'dni', 'phone', 'face', 'friends', 'admin_state_residence_id',
            'admin_state_shipping_id', 'admin_comparsas_id', 'observations'
    ];



    static function get_blank_fields()
    {


        $provinces  = AdminProvinces::all()->pluck('name', 'id');
        $states     = AdminStates::all()->where('admin_province_id',1)->sortBy('name');
        $comparsas  = AdminComparsas::all()->toArray();
        $marketings = self::get_marketings();

        return [
            'name'  => '',
            'last_name'  => '',
            'user_ml'  => '',
            'email'  => '',
            'dni'  => '',
            'phone'  => '',
            'face'  => '',
            'friends'  => false,
            'marketing'  => $marketings,
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

    public static function get_marketings()
    {
      $type = DB::select( DB::raw("SHOW COLUMNS FROM admin_clients WHERE Field = 'marketing'") )[0]->Type;

      $type = str_replace('enum(', '', $type);
      $type = substr($type, 0, -1);
      $enum_val = explode(",'", $type);

      foreach ($enum_val AS $k => $enum)
      {
        $enum_val[$k+1] = str_replace("'", '', $enum);
      }
      unset($enum_val[0]);

      return $enum_val;
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
