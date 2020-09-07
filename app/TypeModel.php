<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    protected $table = 'types';
    protected $fillable = ['name', 'parentId'];

    public $timestamps = false;
}
