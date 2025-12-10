<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
        'status',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
