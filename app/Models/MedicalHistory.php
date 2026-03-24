<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'has_allergies',
        'allergy_types',
        'allergy_others',
        'has_medical_conditions',
        'condition_types',
        'condition_others',
        'has_past_surgery',
        'surgery_details',
        'family_history',
        'cancer_type',
        'family_history_other',
        'smoke_exposure',
        'dominant_hand',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'has_allergies' => 'boolean',
            'allergy_types' => 'array',
            'has_medical_conditions' => 'boolean',
            'condition_types' => 'array',
            'has_past_surgery' => 'boolean',
            'family_history' => 'array',
            'smoke_exposure' => 'boolean',
            'timestamps' => 'datetime',
        ];
    }

    /**
     * Get the student that owns the medical history.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
