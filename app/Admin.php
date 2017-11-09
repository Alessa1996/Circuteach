<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $primaryKey = 'adm_cont';
    protected $table = 'gn_admi';
    public $timestamps = false;

    public function gn_terc()
    {
        return $this->belongsTo('App\Persona','ter_cont',"ter_cont");
    }

}
