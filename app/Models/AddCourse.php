<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_title',
        'course_fee',
        'course_img',
        'desc',
    ];


    public function active_course(){
        return $this->hasMany(ActiveCourse::class,'course_id');
    }

    public function tutorial(){
        return $this->hasMany(Tutorial::class,'course_id');
    }


}
