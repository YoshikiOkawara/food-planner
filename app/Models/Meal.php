<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'ingredients',
        'nutrition_info',
        'user_id',
    ];

    // 追加の設定が必要な場合はここに書きます
}
