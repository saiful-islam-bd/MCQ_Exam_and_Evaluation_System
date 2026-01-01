<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'user_id',
        'total_marks',
        'obtained_marks',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
