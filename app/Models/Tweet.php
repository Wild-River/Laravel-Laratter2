<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['tweet'];

    // 🔽 1対多の関係（ユーザーとツイート）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔽 多対多の関係（いいね機能）
    public function likedByUsers()
    {
        // belongsToManyなので、Laravelは自動的に多対多という関係性であることを認識 = 中間テーブルがあることを認識する。
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // 🔽 1対多の関係（ツイートとコメント）
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
}
