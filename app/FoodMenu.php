<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FoodMenu extends Model
{
use SoftDeletes;
protected $table = 'tblfoodmenu';
protected $primaryKey = 'strFoodMenuMenuId', 'strFoodMenuFoodId';
protected $dates = ['created_at', 'updated_at', 'deleted_at'];
protected $casts = ['strFoodMenuMenuId', 'strFoodMenuFoodId' => 'string'];
}
