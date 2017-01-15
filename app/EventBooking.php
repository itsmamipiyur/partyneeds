<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventBooking extends Model
{
use SoftDeletes;
protected $table = 'tbleventbooking';
protected $primaryKey = 'strEvenBookId';
protected $fillable = ['strEvenBookCustId', 'strEvenBookAddress', 'strEvenBookEvenTypeId', 'txtEvenBookDesc'];
protected $dates = ['strEvenBookTransDate', 'dtmEvenBookSchedule'];
}
