<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Question extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = 'questions';
    protected $with = ['reply'];
    protected $fillable = ['title','slug','body','category_id','user_id','updated_at'];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function category()
    {
        return $this -> belongsTo(Category::class);
    }

    public function reply()
    {
        return $this -> hasMany(Reply::class)->latest();
    }

    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }
}
