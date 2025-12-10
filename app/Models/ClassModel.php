<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
   protected $table = 'class_models'; // optional if table name follows convention

    protected $fillable = [
    'className', 'description', 'teacherName', 'classTime', 'sessionCount', 'month',
];
public function lessons()
{
    return $this->hasMany(Lesson::class, 'class_id');
}
}
