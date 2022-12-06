<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Expertise extends Model
{
    use HasFactory,Softdeletes;
    protected function title() : Attribute{
        return Attribute::make(
            set:fn ($value) => ucwords($value)
        );
    }
}
