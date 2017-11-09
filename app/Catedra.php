<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
  protected $primaryKey = 'cat_cont';
  protected $table = 'ac_cate';
  public $timestamps = false;

  public function ac_curses()
  {
      return $this->hasMany('App\Curso',"cat_cont","cat_cont");
  }
  public function gn_doce()
  {
      return $this->belongsTo('App\Docente',"doc_cont","doc_cont");
  }
  public function ac_asig()
  {
      return $this->belongsTo('App\Asignatura',"asi_cont","asi_cont");
  }

  public function gn_naca()
  {
      return $this->belongsTo('App\NivelAcademico',"nac_cont","nac_cont");
  }
}
