<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyEfficiency extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'beta',
        'R',
        'Pe',
        'N0'
    ];
}
