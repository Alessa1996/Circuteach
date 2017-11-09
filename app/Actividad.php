<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
  protected $primaryKey = 'act_cont';
  protected $table = 'cu_acti';
  public $timestamps = false;

  public function ac_curs()
  {
      return $this->belongsTo('App\Curso',"cur_cont","cur_cont");
  }

  public function cu_asists()
  {
      return $this->hasMany('App\Asistencia',"act_cont","act_cont");
  }

  public function cu_entrs()
  {
      return $this->hasMany('App\Entrega',"act_cont","act_cont");
  }

}
