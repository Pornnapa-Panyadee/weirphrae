<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeirCatchment extends Model
{
    use HasFactory;
    protected $fillable = [
        'weir_id',
        'weir_code',
        'area', 
        'L', 
        'LC', 
        'H', 
        'S', 
        'c', 
        'I', 
        'Return_period', 
        'flow', 
    ];
}
