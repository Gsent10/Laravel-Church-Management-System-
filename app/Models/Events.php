<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'date',
        'attendace_id'
    ];

    public function attendace()
    {
        return $this->belongsTo(Attendace::class);
    }
}
