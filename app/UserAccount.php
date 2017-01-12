<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    //
    protected $table = 'tbluser';
    protected $primaryKey = 'strUserId';
    protected $fillable = ['strUserPassword', 'strUserName'];
}
