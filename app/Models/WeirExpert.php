<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeirExpert extends Model
{
    use HasFactory;
    protected $fillable = [
        'weir_id',            
        'weir_code',
        'weir_problem',
        'weir_solution'
    ];
}
