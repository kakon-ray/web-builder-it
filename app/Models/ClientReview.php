<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{

    protected $fillable = [
        'name',
        'review_star',
        'image',
        'description',
    ];

    use HasFactory;
}
