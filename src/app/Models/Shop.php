<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        // 店舗名
        'detail',      // 店舗の詳細
        'area_id',     // 所属するエリアのID
        'genre_id',    // 所属するジャンルのID
        'image_url',       // 店舗画像
        'user_id',     // 店舗代表者のID
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function favoritesBy()
    {
        return $this->belongsTo(User::class, 'favorites');
    }


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }



}
