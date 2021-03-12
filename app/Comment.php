<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo(People::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
