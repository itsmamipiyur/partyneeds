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
}
