<?php
namespace App\Repositories;


use App\Models\User;
use App\Services\GameService;
use Illuminate\Support\Facades\DB;
use Throwable;

class TeamRegistrationRepository
{
    public function registration(array $request){
        DB::beginTransaction();
        try{
            // get discord info
            $discordUser = (new DiscordAuthRepository)->user($request);

            //Create user
            $user = (new UserRepository)->create(array_merge($request, [
                'discord_id' => $discordUser->id,
                'discord_username'=> $discordUser->username ]));

            // Create polymorphic Game
            $userGame = (new GameService)->create($request);
            // Create Game
            $userGame->game()->create(['user_id' => $user->id]);

            // Choose a team or Create a Team
            DB::commit();
            return 'done';
        }catch (Throwable $e){
            DB::rollBack();
            throw new \Exception($e);
        }



    }
}