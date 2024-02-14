<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Major extends Model
{
    use HasFactory;

    /**
     * 学科が所属する学部を取得
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
