<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'sizeId', 'type', 'subType', 'color', 'price', 'stock'];

    public $timestamps = false;

}
