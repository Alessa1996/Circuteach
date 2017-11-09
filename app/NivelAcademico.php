<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    //
    protected $primaryKey = 'nac_cont';
    protected $table = 'gn_naca';
    public $timestamps = false;

    public function gn_tercs()
    {
        return $this->hasMany('App\Estudiante',"est_cont","est_cont");
    }

    public function ac_cates()
    {
        return $this->hasMany('App\Catedra',"nac_cont","nac_cont");
    }
}
