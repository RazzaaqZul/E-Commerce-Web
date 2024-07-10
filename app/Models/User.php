<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
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
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'fk_id_user', 'id_user');   
    }

    public function carts() : HasMany
    {
        return $this->hasMany(Cart::class, 'fk_id_user', 'id_user');
    }


     // implementasi Authenticable
     public function getAuthIdentifierName()
     {
         // Identifier atau Id nya untuk user nya itu apa?
         return 'email'; // karena yang dipakai username
     }
 
     public function getAuthIdentifier()
     {
         // Dapatkan nilai username nya siapa?
         return $this->email;
     }
 
     public function getAuthPassword()
     {
         // Dapatkan nilai password
         return $this->password;
     }
 
     public function getRememberToken()
     {
         // Untuk dapatkan token;
         return $this->remember_token;
 
     }
 
     public function setRememberToken($value)
     {
         $this->remember_token = $value;
     }
 
     public function getRememberTokenName(){
         return 'remember_token';
     }
}
