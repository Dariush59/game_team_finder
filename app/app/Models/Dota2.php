<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dota2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'dota2_position_ids',
        'matchmaking_ranking_id',
        'region_id',
        'steam_info',
    ];

    public function game()
    {
        return $this->morphOne(Game::class, 'gameable');
    }
}
