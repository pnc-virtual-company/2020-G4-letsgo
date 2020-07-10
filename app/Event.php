<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function Categoies(){
        return $this->hasMany(Category::class);
    }
}
