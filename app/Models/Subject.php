<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'RNC',
        'key',
        'name',
        'section',
        'subject_modality_id',
        'campus',
        'subject_type_id',
        'schedule_id',
        'classroom'
    ];

    public function days(): BelongsToMany
    {
        return $this->belongsToMany(Weekdays::class, 'day_subject');
    }

    public function modality(): BelongsTo
    {
        return $this->belongsTo(SubjectModality::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SubjectType::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
