<?php

namespace App\Repositories\Game;


use App\Models\Dota2;

class Dota2Repository implements GameRepositoryInterface
{
    public function __construct(Dota2 $dota2 = null)
    {
        $this->dota2 = $dota2 ?? new Dota2;
    }

    public function create(array $request){
        return $this->dota2->create(
            array_merge($request, [
                    'matchmaking_ranking_id' => $request['rank'],
                    'region_id' => $request['region'],
                    'dota2_position_ids' =>  json_encode($request['position_ids']),
                    'steam_info' => null
                ]
            )
        );
    }
}