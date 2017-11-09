<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    //
    protected $primaryKey = 'doc_cont';
    protected $table = 'gn_doce';
    public $timestamps = false;

    public function gn_terc()
    {
        return $this->belongsTo('App\Persona','ter_cont',"ter_cont");
    }
    public function ac_cates()
    {
        return $this->hasMany('App\Catedra',"doc_cont","doc_cont");
    }
}
