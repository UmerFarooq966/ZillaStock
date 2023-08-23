<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    Protected $fillable = [

    'user_id', 'image_id'

];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
