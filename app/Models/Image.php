<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Image extends Model
{


    use HasFactory;
    use \Conner\Tagging\Taggable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($image) {
            if (is_null($image->price)) {
                $previousImage = Image::where('catid', $image->catid)->latest()->first();

                if (!is_null($previousImage)) {
                    $image->price = $previousImage->price;
                } else {
                    $image->price = 3; // Set the price to 3 when no previous image exists with the same catid
                }
            }
        });
    }

    protected $fillable = [

       'userid', 'name', 'catid', 'detail', 'image', 'state'

    ];


    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function getReportsCountAttribute()
    {
        return $this->reports()->count();
    }
    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'image_id');
    }


}
