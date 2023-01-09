<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendace extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->hasMany(Events::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

}
