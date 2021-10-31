<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'subject_nm',
        'cost_amt',
    ];

    public function subjectChoice(): HasMany
    {
        return $this->hasMany(SubjectChoice::class, 'subject_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'subject_id');
    }

    public function teacher(): HasMany
    {
        return $this->Hasmany(Teacher::class, 'subject_id');
    }
}
