<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusinessSubject extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }
}
