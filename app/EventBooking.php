<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventBooking extends Model
{
use SoftDeletes;
protected $table = 'tbleventbooking';
protected $primaryKey = 'strEvenBookId';
protected $fillable = ['strEvenBookCustId', 'strEvenBookAddress', 'strEvenBookEvenTypeId', 'txtEvenBookDesc', 'strEvenBookTransDate', 'dtmEvenBookSchedule'];
protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
