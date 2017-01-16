<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FoodCategory extends Model
{
  use SoftDeletes;
  protected $table = 'tblfoodcategory';
  protected $primaryKey = 'strFoodCateId';
  protected $fillable = ['strFoodCateName', 'txtFoodCateDesc'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strFoodCateId' => 'string'];
}
