<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FoodMenu extends Model
{
use SoftDeletes;
protected $table = 'tblfoodmenu';
protected $primaryKey = 'strFoodMenuMenuId', 'strFoodMenuFoodId';
}
