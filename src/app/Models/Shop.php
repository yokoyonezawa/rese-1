<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

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


}
