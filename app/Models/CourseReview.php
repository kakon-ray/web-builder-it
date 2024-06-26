<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
    use HasFactory;



    protected $fillable = [
        'course_id',
        'student_id',
        'name',
        'review_star',
        'description',
        'image',
    ];


    public function add_course(){
        return $this->belongsTo(AddCourse::class,'course_id');
    }

    public function students(){
        return $this->belongsTo(StudentRegModel::class,'student_id');
    }

}
