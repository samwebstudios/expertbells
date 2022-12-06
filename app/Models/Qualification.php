<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Qualification extends Model
{
    use HasFactory,SoftDeletes;
    protected function title():Attribute{
        return Attribute::make(
            set: fn($value) => strtoupper($value)
        );
    }
}
