<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'package_name',
        'description',
        'monthly_fee',
        'class_id', // added
    ];

    // relation: package belongs to one class
    public function classModel()
    {
        return $this->belongsTo(\App\Models\ClassModel::class, 'class_id');
    }
}
