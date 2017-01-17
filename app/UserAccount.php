<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    //
    protected $table = 'tblstaff';
    protected $primaryKey = 'strStafId';
    protected $fillable = ['strStafFirst', 'strStafMiddle', 'strStafLast', 'strStafPassword', 'intStafIsAdmin'];
    protected $casts = ['strStafId' => 'string'];
}
