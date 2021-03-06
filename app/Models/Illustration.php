<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Illustration extends Model
{
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    //いいねされているかを判定
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('illustration_id', $this->id)->first() !==null;
    }
}
