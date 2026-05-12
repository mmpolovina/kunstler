<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Filters extends Model
{
    protected $table = 'filters';
    protected $fillable = ['title', 'filter_group_id'];
    public $timestamps = false;


     public function delete()
    {
        // Delete related filter products
        $this->filter_products()->delete();

        return parent::delete();
    }

    public function group():HasOne
    {
        return $this->HasOne(FilterGroups::class, 'id', 'filter_group_id');
    }
    public function filter_products():HasMany
    {
        return $this->hasMany('App\Models\FilterProducts', 'filter_id');
    }


}
