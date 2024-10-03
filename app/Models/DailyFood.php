<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'meal_time', // 食事の時間帯を追加
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
