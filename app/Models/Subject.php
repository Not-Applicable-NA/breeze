<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'credits',
        'dividend_grade',
        'is_obligatory',
        'semester',
        'day_of_week_1',
        'period_1',
        'is_in_a_row_1',
        'day_of_week_2',
        'period_2',
        'is_in_a_row_2',
        'main_lecture_room',
        'syllabus'
    ];

    /**
     * 教員モデルとのリレーション
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }

    /**
     * クラスとのリレーション
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(ClassList::class, 'class_subject', 'subject_id', 'class_id');
    }

    /**
     * ユーザーとのリレーション
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id');
    }

    /**
     * 全科目を取得
     */
    public function getAllSubjects()
    {
        return $this->all();
    }
}
