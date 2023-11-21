<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassList extends Model
{
    use HasFactory;
    
    /**
     * クラスが所属する学科を取得
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function getAllClasses()
    {
        return $this->all();
    }

    public function getClass($class) {
        return $this->where('class', $class)->first();
    }

}
