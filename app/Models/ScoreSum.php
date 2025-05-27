<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreSum extends Model
{
    use HasFactory;
    protected $fillable = [
        'weir_id',
        'weir_code',
        'score', 
        'class',
        'state',
        'N',
        'Y',
        'O',
        'D',
        'amp',
        'class_1',
        'damage_1',
        'damage_2',
        'damage_3',
        'damage_4',
        'damage_5',
        'damage_6',
        'damage_score_1', 
        'damage_score_2', 
        'damage_score_3', 
        'damage_score_4', 
        'damage_score_5', 
        'damage_score_6', 
    ];

}
