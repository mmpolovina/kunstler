<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterProducts extends Model
{
    protected $table = 'filter_products';
    protected $fillable = ['product_id', 'filter_id', 'filter_group_id'];

}
