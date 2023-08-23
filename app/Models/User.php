<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use Billable;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param  integer  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "team", "admin"][$value],
        );
    }


    public function UserProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
    // User.php

    // Relationship with purchases
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'user_id');
    }

    // Relationship with seller balances
    public function sellerBalance()
    {
        return $this->hasOne(SellerBalance::class, 'seller_id');
    }

}
