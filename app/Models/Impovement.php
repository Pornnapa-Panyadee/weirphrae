<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impovement extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'weir_id',
        'weir_code',
        'weir_amp',
        'improve_type'
    ];
}
