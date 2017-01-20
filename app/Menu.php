<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
  use SoftDeletes;
  protected $table = 'tblmenu';
  protected $primaryKey = 'strMenuId';
  protected $fillable = ['dblMenuRate', 'strMenuMenuType', 'txtMenuDesc'];
  protected $dates = ['dtmMenuCreatedAt', 'created_at', 'updated_at', 'deleted_at'];
}
