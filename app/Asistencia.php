<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
  protected $primaryKey = 'ast_cont';
  protected $table = 'cu_asis';
  public $timestamps = false;

  public function gn_estu()
  {
      return $this->belongsTo('App\Actividad','act_cont',"act_cont");
  }
  public function ac_curs()
  {
      return $this->belongsTo('App\Matricula','mat_cont',"mat_cont");
  }
  
}
