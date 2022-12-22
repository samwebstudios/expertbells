<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpQuery extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasOne(User::class,'id','type_id');
    }
    public function expert(){
        return $this->hasOne(Expert::class,'id','type_id');
    }
}
