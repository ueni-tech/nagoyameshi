<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Restaurant extends Model
{
    use HasFactory, Sortable, Favoriteable;

    protected $fillable = [
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function regular_holidays()
    {
        return $this->belongsToMany(Regular_holiday::class)->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // opening_time のカスタムアクセサ
    public function getOpeningTimeAttribute($value)
    {
        return $this->createTimeFromFormat($value);
    }

    // closing_time のカスタムアクセサ
    public function getClosingTimeAttribute($value)
    {
        return $this->createTimeFromFormat($value);
    }

    // 時間のフォーマットを処理する共通メソッド
    protected function createTimeFromFormat($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }
}
