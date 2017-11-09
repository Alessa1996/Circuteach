<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
  protected $primaryKey = 'ent_cont';
  protected $table = 'cu_entr';
  public $timestamps = false;

  public function cu_matri()
  {
      return $this->belongsTo('App\Matricula','mat_cont',"mat_cont");
  }

  public function ac_acti()
  {
      return $this->belongsTo('App\Actividad','act_cont',"act_cont");
  }
}
