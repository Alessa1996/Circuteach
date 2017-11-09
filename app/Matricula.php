<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
  protected $primaryKey = 'mat_cont';
  protected $table = 'cu_matri';
  public $timestamps = false;

  public function gn_estu()
  {
      return $this->belongsTo('App\Estudiante','est_cont',"est_cont");
  }
  public function ac_curses()
  {
      return $this->belongsTo('App\Curso','cur_cont',"cur_cont");
  }
  public function cu_asis()
  {
      return $this->hasMany('App\Asistencia',"mat_cont","mat_cont");
  }
  public function cu_entr()
  {
      return $this->hasMany('App\Entrega',"mat_cont","mat_cont");
  }
}
