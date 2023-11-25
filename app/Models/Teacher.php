<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'laboratory_no'
    ];

    /**
     * 全教員を取得
     */
    public function getAllTeachers()
    {
        return $this->all();
    }
}
