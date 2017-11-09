<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //
    protected $primaryKey = 'est_cont';
    protected $table = 'gn_estu';
    public $timestamps = false;

    public function gn_naca()
    {
        return $this->belongsTo('App\NivelAcademico',"nac_cont","nac_cont");
    }

    public function gn_terc()
    {
        return $this->belongsTo('App\Persona',"ter_cont","ter_cont");
    }
}
