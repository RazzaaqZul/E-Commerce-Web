<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'email',
        'username',
        'password',
        'fullname',
        'gender',
        'remember_token',
        'address'
    ];

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'fk_id_user', 'id_user');   
    }

    public function carts() : HasMany
    {
        return $this->hasMany(Cart::class, 'fk_id_user', 'id_user');
    }
}
