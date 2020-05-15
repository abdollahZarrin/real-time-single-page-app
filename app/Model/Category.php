<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function questions()
    {
        return $this -> hasMany(Question::class);
    }
}
