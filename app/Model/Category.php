<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','slug'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function questions()
    {
        return $this -> hasMany(Question::class);
    }

}
