<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Weekdays extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'day_subject');
    }
}
