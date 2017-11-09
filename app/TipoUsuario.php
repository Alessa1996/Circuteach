<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    //
    protected $primaryKey = 'tus_cont';
    protected $table = 'gn_tusu';
    public $timestamps = false;

    public function gn_tercs()
    {
        return $this->hasMany('App\Persona',"tdo_cont","tdo_cont");
    }
}
