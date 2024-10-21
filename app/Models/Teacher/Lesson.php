<?php

namespace App\Models\Teacher;

use App\Models\Admin\Classes;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable=['text','title','video','classId'];

    public function class()
    {
        return $this->belongsTo(Classes::class,'classId');
    }
}
