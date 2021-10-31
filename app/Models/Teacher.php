<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'first_nm',
        'last_nm',
        'dob',
        'subject_id',
        'email',
        'gender',
    ];

    public function subjectChoice(): HasMany
    {
        return $this->hasMany(SubjectChoice::class,'subject_id');
    }

    public function subjects(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
