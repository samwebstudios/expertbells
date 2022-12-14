<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;
    public function jobs(){
        return $this->hasOne(Career::class,'id','job');
    }
}
