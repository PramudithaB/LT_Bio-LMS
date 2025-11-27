<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class_models';   // explicit table name (optional)
    protected $fillable = [
        'className',
        'description',
        'teacherName',
        'classTime',
        'sessionCount',
        'month',
    ];
}
