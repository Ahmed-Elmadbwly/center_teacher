<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['questionId', 'optionText', 'isCorrect'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
