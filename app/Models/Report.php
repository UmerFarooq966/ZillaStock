<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

}
