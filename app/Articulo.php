<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
  protected $primaryKey = 'art_cont';
  protected $table = 'cu_arti';
  public $timestamps = false;

  public function gn_terc()
  {
      return $this->belongsTo('App\Persona','ter_cont',"ter_cont");
  }

}
