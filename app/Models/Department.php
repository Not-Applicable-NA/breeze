<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    /**
     * 学部に所属する学科を取得
     */
    public function majors(): HasMany
    {
        return $this->hasMany(Major::class);
    }
}
