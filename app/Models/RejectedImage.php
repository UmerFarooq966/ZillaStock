<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedImage extends Model
{
    use HasFactory;
    protected $fillable = [

        'image_id', 'rejection_reason', 'rejection_date'

    ];

}
