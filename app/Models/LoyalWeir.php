<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyalWeir extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'weir_name',         
        'weir_type',         
        'weir_size',
        'weir_status',
        'tambol',
        'district',
        'province',
        'latitude',
        'longitude',

        'weir_idea_year',
        'weir_receive_year',
        'weir_king_of',
        'weir_law',
        'weir_start_year',
        'weir_finish_year',
        'weir_storage',
        'weir_area',
        'weir_use',
        'family',
        'weir_system'
    ];
}
