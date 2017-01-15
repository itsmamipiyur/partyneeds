<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventType extends Model
{
use SoftDeletes;
protected $table = 'tbleventtype';
protected $primaryKey = 'strEvenTypeId';
protected $fillable = ['strServName', 'strEvenTypeName', 'strEvenTypeDesc'];
}
