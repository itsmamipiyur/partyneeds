<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PackageMenu extends Model
{
use SoftDeletes;
protected $table = 'tblservice';
protected $primaryKey = 'strPackMenuPackId', 'strPackMenuMenuId';
protected $dates = ['created_at', 'updated_at', 'deleted_at'];
protected $casts = ['strPackMenuPackId', 'strPackMenuMenuId' => 'string'];
}
