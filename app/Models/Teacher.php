<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'laboratory_no'
    ];
    
    public function businessSubjects(): BelongsToMany
    {
        return $this->belongsToMany(BusinessSubject::class);
    }

    /**
     * 全教員を取得
     */
    public function getAllTeachers()
    {
        return $this->all();
    }

    /**
     * 教員を取得
     */
    public function getTeacher($teacherId)
    {
        return $this->find($teacherId);
    }
}
