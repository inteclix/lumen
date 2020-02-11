<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
