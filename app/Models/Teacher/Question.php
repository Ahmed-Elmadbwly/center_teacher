<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quizId', 'questionText'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class,'questionId');
    }
}
