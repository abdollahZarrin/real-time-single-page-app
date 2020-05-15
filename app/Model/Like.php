<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $guarded = [];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function reply()
    {
        return $this -> belongsTo(Reply::class);
    }
}
