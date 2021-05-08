<?php

namespace App\Repositories;


use app\Models\Game\GameInterface;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TeamRepository
{
    public function createOrUpdate(GameInterface $game, array $request)
    {
        $dotaPositionIds = json_decode($game->position_ids);
        $team = Team::whereGameName($request['game'])->where('free_spot', '!=', 0);
        // Check and create Positions
        $this->getFreePositionSpot($team, $dotaPositionIds);
        if (!$team->count())
            return $this->create($request, $team);
        // Check and create Rank
        $mostMatchedRank = clone $this->getTheMostMatchedRank($game, $team);
        if (!$team->count())
            return $this->create($request, $team);
        // Check and create Region
        $this->getTeamsWithSameRegion($game, $team);
        if (!$team->count())
            return $this->update($mostMatchedRank, $dotaPositionIds);
        // best case scenario
        return $this->update($team, $dotaPositionIds);
    }

    public function create(array $request, $team)
    {
        return $team->create(array_merge($request, [
            'game_name' => $request['game'],
            'position_ids' => $request['position_ids'],
            'is_complete' => false,
            'free_spot' => '4',
            'region_id' => $request['region'],
        ]));
    }

    public function update($team, $gamePositionIds)
    {
        $teamPositionIds = json_decode($team->get()->first()->position_ids);
        $latestTeamPositionIds = array_merge($teamPositionIds, array_diff($gamePositionIds, $teamPositionIds));
        return $team->orderBy('free_spot')->limit(1)->update( [
            'position_ids' => $latestTeamPositionIds,
            'is_complete' =>  count($latestTeamPositionIds) == 5,
            'free_spot'=> DB::raw('free_spot - 1')
        ]);
    }

    private function getFreePositionSpot($team, $dotaPositionIds) : Builder
    {
        return $team->where(function (Builder $query) use ($dotaPositionIds) {
            $query->whereJsonDoesntContain('position_ids', $dotaPositionIds[0]);
            if (count($dotaPositionIds) == 2)
                $query->orWhereJsonDoesntContain('position_ids', $dotaPositionIds[1]);
            return $query->orWhere(function (Builder $query){
                return $query->whereIsComplete(true)->where('free_spot', '!=', 0);
            });
        });
    }

    private function getTheMostMatchedRank(GameInterface $game, $team) : Builder
    {
        $rank = $game->matchmaking_ranking_id;
        return $team->whereIn('rank', [$rank - 1, $rank, $rank + 1]);
    }

    private function getTeamsWithSameRegion(GameInterface $game, $team) : Builder
    {
        return $team->where('region_id', $game->region_id);
    }




}