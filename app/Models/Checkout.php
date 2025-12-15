<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'student_name',
        'class_name',
        'class_id',
        'remark',
        'file_path',
        'status',
        'user_id', // added so controller can save current user
    ];
}
