<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Food extends Model
{
use SoftDeletes;
protected $table = 'tblfood';
protected $primaryKey = 'strFoodId';
protected $fillable = ['strFoodName', 'strFoodFoodCateId', 'txtFoodDesc'];
}
