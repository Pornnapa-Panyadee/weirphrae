<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DwrWeir extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'weir_name',
        'moo',
        'village',
        'tambol',
        'district',
        'province',
        'river',
        'latitude',
        'longitude',
        'weir_area',
        'weir_build_year',
        'weir_use'
    ];
}
