<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $primaryKey = 'ter_cont';
    protected $table = 'gn_terc';
    public $timestamps = false;

    public function gn_tdoc()
    {
        return $this->belongsTo('App\TipoDocumento',"tdo_cont","tdo_cont");
    }
    public function gn_tusu()
    {
        return $this->belongsTo('App\TipoUsuario',"tus_cont","tus_cont");
    }
    public function gn_estus()
    {
        return $this->hasMany('App\Estudiante',"est_cont","esto_cont");
    }
    public function gn_doces()
    {
        return $this->hasMany('App\Docente',"doc_cont","doc_cont");
    }
    public function gn_admis()
    {
        return $this->hasMany('App\Admin',"adm_cont","adm_cont");
    }
    public function cu_artis()
    {
        return $this->hasMany('App\Articulo',"ter_cont","ter_cont");
    }



}
