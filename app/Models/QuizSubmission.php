<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_type',
        'visitor_name',
        'score',
        'total_questions',
        'percentage',
        'answers_json',
    ];

    protected $casts = [
        'answers_json' => 'array',
    ];
}
