<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourLocation extends Model
{
    use HasFactory , SoftDeletes;

    public $table = 'tour_locations';

    protected $fillable =[
        'tour_id',
        'latitude',
        'longitude',
    ];
}
