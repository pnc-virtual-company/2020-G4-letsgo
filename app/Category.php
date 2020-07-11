<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Events(){
        return $this->hasMany(Event::class);
    }
}
