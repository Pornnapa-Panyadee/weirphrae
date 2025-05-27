<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RidWeir extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'weir_name',
        'weir_detail',
        'moo',
        'village',
        'tambol',
        'district',
        'province',
        'latitude',
        'longitude',
        'budget_from',
        'weir_type',
        'weir_area',
        'weir_use',
        'weir_storage',
        'weir_system',
        'weir_build_year',
        'weir_tranfer_year',
        'weir_tranfer_unit',
        'weir_tranfer_status',
    ];
}
