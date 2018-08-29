<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminExternalLinks extends Model
{

    protected $table = 'admin_external_links';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'rel_id', 'type', 'code', 'updated_at', 'created_at' ];



}
