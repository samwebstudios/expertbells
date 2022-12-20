<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Softdeletes,Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function name() : Attribute{
        return Attribute::make(
            set: fn($value) => [
                'name' => ucwords($value),
                'user_id' => generateuserno()
            ]
        );
    }
    public function roles(){
        return $this->hasOne(Role::class,'id','role');
    }
    public function industries(){
        return $this->hasOne(Expertise::class,'id','industry');
    }
    public function countires(){
        return $this->hasOne(Country::class,'id','country');
    }
    public function states(){
        return $this->hasOne(State::class,'id','state');
    }
    public function cities(){
        return $this->hasOne(City::class,'id','city');
    }
}