<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tblstaff';
    protected $primaryKey = 'strStafId';
    protected $fillable = ['strStafFirst', 'strStafMiddle', 'strStafLast', 'strStafPassword', 'intStafIsAdmin'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['strStafId' => 'string'];
}
