<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [

        'user_id', 'full_name', 'bio', 'avatar', 'phone', 'address', 'city', 'state', 'zip' ,'instagram', 'facebook', 'twitter'

    ];

}
