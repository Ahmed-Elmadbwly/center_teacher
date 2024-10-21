<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'description','time'];

    public function questions()
    {
        return $this->hasMany(Question::class,'quizId');
    }
}
