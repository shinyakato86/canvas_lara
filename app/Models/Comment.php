<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id', 'users', 'illustration_id');
    }

}

