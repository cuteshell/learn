<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function children()
    {
        return $this->hasMany('App\Models\Category','pid');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category','pid');
    }
}
