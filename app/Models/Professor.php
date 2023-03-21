<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Professor extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the professor.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the professor's jobs.
     */
    public function jobs(): MorphMany
    {
        return $this->morphMany(Job::class, 'employee');
    }
}
