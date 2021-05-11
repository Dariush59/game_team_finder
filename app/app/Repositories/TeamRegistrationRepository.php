<?php
namespace App\Repositories;


use App\Events\TeamHasCompleted;
use App\Models\Team;
use App\Services\DiscordAuthService;
use App\Services\GameService;
use Illuminate\Support\Facades\DB;
use stdClass;
use Throwable;

class TeamRegistrationRepository
{
    public function registration(array $request){
        $request = $this->reformRequest($request);
        DB::beginTransaction();
        try{
            // get discord info
            $discordUser = (new DiscordAuthService)
                ->user($request);
            //Create user
            $user = (new UserRepository)
                ->create($this->mergeDiscord($request, $discordUser));
            // Create polymorphic Game (example Dota2)
            $gameIns = GameService::instance($request['game'])
                ->create($request);
            // Create team
            $team = (new TeamRepository)
                ->createOrUpdate($gameIns, $request);
            // Create Game (GameTable)
            $player = $gameIns->gamePlayer()
                ->create(['user_id' => $user->id, 'team_id' => is_int($team) ? $team : $team->id ]);
            // Event listener to notify team members
            if (is_int($team)) $this->notifyTeamHasCompleted($team, $player);
            DB::commit();
            return 'done';
        }catch (Throwable $e){
            DB::rollBack();
            throw new \Exception($e);//DB exception
        }
    }

    /**
     * @param array $request
     * @param stdClass $discordUser
     * @return array
     */
    private function mergeDiscord(array $request, stdClass $discordUser)
    {
        return array_merge($request, [
            'discord_id' => $discordUser->id,
            'discord_username' => $discordUser->username]);
    }

    private function reformRequest(array $request){
        return array_merge($request,
            ['position_ids' => $this->reformPositionIds($request)]);
    }

    private function reformPositionIds(array $request): string
    {
        return collect($request['position_ids'])->map(function ($position) {
            return $position['id'];
        })->toJson();
    }

    private function notifyTeamHasCompleted($team, $player): void
    {
        $freeSpot =  Team::find($team)->free_spot;
        if (!$freeSpot){
            $player->first()->whereTeamId($team)->with('user')->get()->each(function ($game) {
                event(new TeamHasCompleted($game->user));
            });
        }

    }
}