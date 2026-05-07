<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'company_name',
        'job_position',
        'salary',
        'waiting_time',
        'job_relevance',
        'university_name',
        'study_major',
        'level',
        'feedback',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'waiting_time' => 'integer',
        'job_relevance' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'working' => 'Bekerja',
            'studying' => 'Melanjutkan Studi',
            'entrepreneur' => 'Wirausaha',
            'unemployed' => 'Belum Bekerja',
            default => 'Tidak Diketahui',
        };
    }
}