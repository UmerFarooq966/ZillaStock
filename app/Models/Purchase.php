<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with seller
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
