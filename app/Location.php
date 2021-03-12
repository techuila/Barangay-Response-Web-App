<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
