<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    //
    protected $primaryKey = 'tdo_cont';
    protected $table = 'gn_tdoc';
    public $timestamps = false;

    public function gn_tercs()
    {
        return $this->hasMany('App\Persona',"tdo_cont","tdo_cont");
    }
}
