<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{

  use SoftDeletes;
  protected $table = 'tblequipment';
  protected $primaryKey = 'strEquiId';
  protected $fillable = ['strEquiName', 'txtEquiDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strEquiId' => 'string'];

  public function equipmentType()
  {
      return $this->belongsTo('App\EquipmentType')->withTrashed();
  }
}
