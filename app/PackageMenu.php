<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PackageMenu extends Model
{
use SoftDeletes;
protected $table = 'tblservice';
protected $primaryKey = 'strPackMenuPackId', 'strPackMenuMenuId';
}
