<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFilters extends Model
{
    protected $table = 'category_filters';
    protected $fillable = ['category_id', 'filter_group_id'];

}
