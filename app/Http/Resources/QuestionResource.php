<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this -> title,
            'slug' => $this -> slug,
            'path' => $this -> path,
            'body' => $this -> body,
            'user' => $this -> user -> name,
            'category' => $this -> category -> name,
            'created_at' => Jalalian::forge($this -> created_at) -> ago(),
            'own' => (auth() -> user()) && ($this -> user -> id === auth()->user() -> id) ? true : false
        ];
    }
}
