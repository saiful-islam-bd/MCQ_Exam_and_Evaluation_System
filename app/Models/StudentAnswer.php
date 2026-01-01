<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'mcq_question_id',
        'mcq_option_id',
        'is_correct',
        'marks_obtained',
    ];

    public function question()
    {
        return $this->belongsTo(McqQuestion::class);
    }

    public function option()
    {
        return $this->belongsTo(McqOption::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

