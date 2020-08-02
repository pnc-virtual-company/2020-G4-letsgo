<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\User;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Pivot
{
    public function join(){
        return $this->belongsTo(User::class, 'type');
    }
}