<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'package_name',
        'description',
        'monthly_fee',
    ];
}
