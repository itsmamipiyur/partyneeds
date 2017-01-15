<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceType extends Model
{
use SoftDeletes;
protected $table = 'tblservicetype';
protected $primaryKey = 'strServTypeId';
protected $fillable = ['strServTypeName', 'txtServTypeDesc'];
}
