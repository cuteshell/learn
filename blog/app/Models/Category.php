<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany('App\Models\Category','pid')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category','pid');
    }
}
