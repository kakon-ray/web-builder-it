<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCourse extends Model
{
    use HasFactory;


    protected $fillable = [
        'student_id',
        'course_id',
        'pement_clear',
        'status',
    ];


    public function students(){
        return $this->belongsTo(StudentRegModel::class,'student_id');
    }

    public function add_course(){
        return $this->belongsTo(AddCourse::class,'course_id');
    }

}
