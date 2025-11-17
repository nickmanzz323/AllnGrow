<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    //
    use HasFactory;
    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
