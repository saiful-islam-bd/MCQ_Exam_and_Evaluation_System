<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqQuestion extends Model
{
    protected $fillable = ['question', 'mark'];

    public function options()
    {
        return $this->hasMany(McqOption::class);
    }
}
