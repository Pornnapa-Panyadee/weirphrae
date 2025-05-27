<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreWeight extends Model
{
    use HasFactory;
    protected $fillable = [
        'part1',
        'part2',
        'part3',
        'part4',
        'part5',
        'part6',
        'point',
        'devide',
    ];
}
