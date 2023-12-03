<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassList extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     */
    protected $table = 'classes';
    
    /**
     * クラスが所属する学科を取得
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * クラスに所属するユーザーを取得
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * 科目とのリレーション設定
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function getAllClasses()
    {
        return $this->all();
    }

    public function getClass($class) {
        return $this->where('name', $class)->first();
    }

}
