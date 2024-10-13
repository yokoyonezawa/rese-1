<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function shops() {
        return $this->belongsTo(Shop::class);
    }
}
