<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class FilterGroups extends Model
{
    protected $table = 'filter_groups';
    protected $fillable = ['title'];
    public $timestamps = false;

    #[Override]
    public function delete()
    {
        // Delete related filters
        $this->filters()->delete();
        // Delete related filter products
        $this->filter_products()->delete();
        // Delete related filter categories
        $this->filter_categories()->delete();

        return parent::delete();
    }

    public function filters():HasMany
    {
        return $this->hasMany('App\Models\Filters', 'filter_group_id');
    }
    public function filter_products():HasMany
    {
        return $this->hasMany('App\Models\FilterProducts', 'filter_group_id');
    }
    public function filter_categories():HasMany
    {
        return $this->hasMany('App\Models\CategoryFilters', 'filter_group_id');
    }

}
