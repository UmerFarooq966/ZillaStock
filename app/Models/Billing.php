<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    Protected $fillable = [

        'BankAccount', 'routing_number',
        'Accoun_older_name', 'image_id'


    ];
}
