<?php

namespace App\Models\Teacher;

use App\Models\Admin\Classes;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable=['title','file','classId'];

    public function class()
    {
        return $this->belongsTo(Classes::class,'classId');
    }
}
