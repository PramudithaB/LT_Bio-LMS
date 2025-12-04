<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
   protected $fillable = [
    'class_id',
    'name',
    'description',
    'link',
    'file_path',
    'notice',
    'is_paid',
];
 public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
