<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  // 配列内の要素を書き込み可能にする
  protected $fillable = ['illustration_id','user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

    //いいねしている投稿
    public function post()
    {
        return $this->belongsTo(Illustration::class);
    }


}

