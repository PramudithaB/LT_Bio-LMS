<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
   protected $table = 'class_models'; // optional if table name follows convention

    protected $fillable = [
    'className', 'description', 'teacherName', 'classTime', 'sessionCount', 'month',
    'week1Name', 'week1Desc', 'week1LongDesc', 'week1Link', 'specialNoticeW1', 'week1Files',
    'week2Name', 'week2Desc', 'week2LongDesc', 'week2Link', 'specialNoticeW2', 'week2Files',
    'week3Name', 'week3Desc', 'week3LongDesc', 'week3Link', 'specialNoticeW3', 'week3Files',
    'week4Name', 'week4Desc', 'week4LongDesc', 'week4Link', 'specialNoticeW4', 'week4Files',
    'specialClassName', 'specialClassDesc', 'specialClassLongDesc', 'specialClassLink', 'specialNoticeSC', 'specialClassFiles',
];
}
