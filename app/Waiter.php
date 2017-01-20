<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Waiter extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tblwaiter';
    protected $primaryKey = 'strWaitId';
    protected $fillable = ['strWaitFirst', 'strWaitMiddle', 'strWaitLast'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['strWaitId' => 'string'];
}
