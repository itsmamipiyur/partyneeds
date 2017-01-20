<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Motif extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tblmotif';
    protected $primaryKey = 'strMotiId';
    protected $fillable = ['strMotiName', 'txtMotiDesc'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['strMotiId' => 'string'];
}
