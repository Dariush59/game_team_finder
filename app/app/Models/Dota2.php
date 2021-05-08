<?php

namespace App\Models;

use App\Models\Game\GameInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dota2 extends Model implements GameInterface
{
    use HasFactory;

    protected $fillable = [
        'position_ids',
        'matchmaking_ranking_id',
        'region_id',
        'steam_info',
    ];

    public function gamePlayer()
    {
        return $this->morphOne(Game::class, 'gameable');
    }
}
