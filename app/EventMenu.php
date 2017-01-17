<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventMenu extends Model
{
use SoftDeletes;
protected $table = 'tbleventmenu';
protected $primaryKey = 'strEvenMenuEvenBookId','strEvenMenuMenuId';
protected $fillable = ['intEvenMenuPax'];
protected $dates = ['created_at', 'updated_at', 'deleted_at'];
protected $casts = ['strEvenMenuEvenBookId', 'strEvenMenuMenuId' => 'string']
}
