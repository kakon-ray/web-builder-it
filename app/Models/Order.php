<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'send_phone_num',
        'amount',
        'address',
        'status',
        'transaction_id',
        'currency',
        'pement_method',
        'active_course_id',
        'course_id',
    ];

    use HasFactory;
}
