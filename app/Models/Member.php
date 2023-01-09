<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 
        'surname', 
        'middle_name', 
        'birthday', 
        'state', 
        'lga', 
        'address', 
        'email', 
        'phone', 
        'department_id',
        'cell_id',
        'img_path'
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function attendaces()
    {
        return $this->belongsToMany(Attendace::class);
    }
}
