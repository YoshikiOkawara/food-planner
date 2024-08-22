<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'rating_total',
        'rating_count',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // 特定のユーザーによる評価を取得するメソッド
    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }

    public function likes()
    {
    return $this->hasMany(Like::class);
    }

}
