<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagecategory extends Model
{
    use HasFactory;
   protected $fillable = ['type'];

    public function images()
    {
        return $this->hasMany(Image::class, 'catid');
    }

}
