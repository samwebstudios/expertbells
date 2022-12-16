<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class SlotBook extends Model
{
    use HasFactory,Softdeletes;
    protected $guarded = ['id']; 
    public function expert(){
        return $this->hasOne(Expert::class,'id','expert_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function reassign(){
        return $this->hasOne(SlotBook::class,'id','reassign_slot');
    }
    public function preassign(){
        return $this->hasOne(SlotBook::class,'reassign_slot','id');
    }
    public function reschedule(){
        return $this->hasOne(SlotBook::class,'id','reschedule_slot');
    }
    public function prereschedule(){
        return $this->hasOne(SlotBook::class,'reschedule_slot','id');
    }
}
