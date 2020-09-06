<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizeModel extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['name'];

    public $timestamps = false;
}
