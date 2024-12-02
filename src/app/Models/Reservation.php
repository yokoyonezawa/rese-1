<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'user_id',
        'date',
        'time',
        'number',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('Y年m月d日');
    }

    public function getFormattedTimeAttribute()
    {
        return date('H:i', strtotime($this->time));
    }

    protected $casts = [
        'date' => 'datetime', // Carbonインスタンスとして扱う
    ];

}
