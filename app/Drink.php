<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drink extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tbldrink';
    protected $primaryKey = 'strDrinkId';
    protected $fillable = ['strDrinkName', 'txtDrinkDesc'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['strDrinkId' => 'string'];
}
