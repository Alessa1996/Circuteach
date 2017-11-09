<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{

  protected $primaryKey = 'asi_cont';
  protected $table = 'ac_asig';
  public $timestamps = false;

  public function ac_cates()
  {
      return $this->hasMany('App\Catedra',"asi_cont","asi_cont");
  }
}
