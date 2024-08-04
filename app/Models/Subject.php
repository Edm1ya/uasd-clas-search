<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
