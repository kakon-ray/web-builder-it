<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursecategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_slug',
    ];

    public function add_course(){
        return $this->hasMany(AddCourse::class,'coursecategory_id');
    }
}
