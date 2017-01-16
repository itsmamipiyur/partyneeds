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
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts = ['strFoodId' => 'string'];

  public function foodCategory()
  {
      return $this->belongsTo('App\FoodCategory', 'strFoodFoodCateId')->withTrashed();
  }
}
