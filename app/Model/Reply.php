<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';
    protected  $guarded = [];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function question()
    {
        return $this -> belongsTo(Question::class);
    }

    public function like()
    {
        return $this -> hasMany(Like::class);
    }
}
