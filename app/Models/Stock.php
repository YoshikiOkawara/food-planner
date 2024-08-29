<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // 設定可能な属性
    protected $fillable = [
        'user_id',
        'ingredient_name', // 変更
        'quantity',
        'expiration_date',
        'best_before_date',
    ];
    
    // 日付フィールドのキャスト
    protected $casts = [
        'expiration_date' => 'date',
        'best_before_date' => 'date',
    ];
    
    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 食材とのリレーションは削除
    // public function ingredient()
    // {
    //     return $this->belongsTo(Ingredient::class);
    // }
}
