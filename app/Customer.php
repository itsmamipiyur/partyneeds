<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{

    use SoftDeletes;
    protected $table = 'tblcustomer';
    protected $primaryKey = 'strCustId';
    protected $fillable = ['strCustFirst', 'strCustMiddle', 'strCustLast', 'strCustAddress', 'strCustContact'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['strCustId' => 'string'];
}
