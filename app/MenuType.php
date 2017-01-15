<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuType extends Model
{
use SoftDeletes;
protected $table = 'tblmenutype';
protected $primaryKey = 'strMenuTypeId';
protected $fillable = ['strMenuTypeName', 'txtMenuTypeDesc'];
}
