<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Filtes extends Model
{
    protected $table = 'filters';
    protected $fillable = ['title', 'filter_group_id'];
    public $timestamps = false;


    public function group():HasOne
    {
        return $this->HasOne(FilterGroups::class, 'id', 'filter_group_id');
    }


 
}
