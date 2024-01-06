<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'first_start',
        'first_first_half_end',
        'first_second_half_start',
        'first_end',
        'second_start',
        'second_first_half_end',
        'second_second_half_start',
        'second_end'
    ];

    public function getSemester()
    {
        return $this->first();
    }
}
