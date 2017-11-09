<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
  protected $primaryKey = 'cur_cont';
  protected $table = 'ac_curs';
  public $timestamps = false;

  public function ac_cate()
  {
      return $this->belongsTo('App\Catedra',"cat_cont","cat_cont");
  }
  public function cu_matris()
  {
      return $this->hasMany('App\Matricula',"cur_cont","cur_cont");
  }
  public function cu_actis()
  {
      return $this->hasMany('App\Actividad',"cur_cont","cur_cont");
  }
}
