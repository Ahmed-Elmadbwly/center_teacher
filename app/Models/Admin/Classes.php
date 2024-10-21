<?php

namespace App\Models\Admin;

use App\Models\Teacher\Assignment;
use App\Models\Teacher\Lesson;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable=['title'];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }
}
