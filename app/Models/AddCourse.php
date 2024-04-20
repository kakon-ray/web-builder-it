<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'coursecategory_id',
        'batch',
        'course_title',
        'instructor',
        'duration',
        'lectures',
        'language',
        'projects',
        'status',
        'course_fee',
        'new_course_fee',
        'course_img',
        'desc',
    ];


    public function active_course(){
        return $this->hasMany(ActiveCourse::class,'course_id');
    }

    public function tutorial(){
        return $this->hasMany(Tutorial::class,'course_id');
    }

    public function course_catagory(){
        return $this->belongsTo(Coursecategory::class,'coursecategory_id');
    }
}
