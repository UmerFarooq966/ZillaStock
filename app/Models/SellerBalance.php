<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerBalance extends Model
{
    use HasFactory;

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
