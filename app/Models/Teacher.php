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
    
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * 全教員を取得
     */
    public function getAllTeachers()
    {
        return $this->all();
    }
}
