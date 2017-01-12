<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentType extends Model
{
  use SoftDeletes;
  protected $table = 'tblequipmenttype';
  protected $primaryKey = 'strEquiTypeId';
  protected $fillable = ['strEquiTypeName', 'txtEquiTypeDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strEquiTypeId' => 'string'];
}
