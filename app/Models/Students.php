<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Students extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'first_nm',
        'last_nm',
        'dob',
        'class',
        'phone_nbr',
        'email',
        'gender',
    ];

    public function subjectChoice(): HasMany
    {
        return $this->hasMany(SubjectChoice::class, 'student_id')->with('subjects');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'student_id');
    }
}
