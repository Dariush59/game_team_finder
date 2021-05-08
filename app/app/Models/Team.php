<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name',
        'position_ids',
        'rank',
        'is_complete',
        'free_spot',
        'region_id',
    ];
}
