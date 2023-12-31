<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    public function add_course(){
        return $this->belongsTo(AddCourse::class,'course_id');
    }
}
