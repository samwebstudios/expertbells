<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Expert extends Authenticatable
{
    use HasFactory, HasFactory, Notifiable,Softdeletes;
    protected function name() : Attribute{
        return Attribute::make(
            set: fn($value,$userid) => [
                'name' => ucwords($value),
                'user_id' => generateexpertno()
            ]
        );
    }
    public function qualification(){
        return $this->hasOne(Qualification::class,'id','highest_qualification');
    }
    public function expertise(){
        return $this->hasOne(Expertise::class,'id','your_expertise');
    }
}
