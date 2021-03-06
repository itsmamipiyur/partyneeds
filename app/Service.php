<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
use SoftDeletes;
protected $table = 'tblservice';
protected $primaryKey = 'strServId';
protected $fillable = ['strServName', 'strServServType', 'txtServDesc', 'dblServRate'];
protected $dates = ['created_at', 'updated_at', 'deleted_at'];
protected $casts = ['strServId' => 'string'];
}
