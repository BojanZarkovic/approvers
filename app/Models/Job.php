<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Job extends Model
{
    use HasFactory;


    /**
     * Get the parent employee model (trader or professor).
     */
    public function employee(): MorphTo
    {
        return $this->morphTo();
    }


    /**
     * Get the approvals for the job.
     */
    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class);
    }
}
