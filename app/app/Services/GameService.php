<?php
/**
 * Created by PhpStorm.
 * User: dariush
 * Date: 05/05/2021
 * Time: 9:54 PM
 */

namespace App\Services;


use App\Repositories\Game\Dota2Repository;

class GameService
{
    public static function instance(string $game = null)
    {
        if (self::getName($game) == 'dota2')
            return new Dota2Repository;

    }

    private static function getName(string $game = null)
    {
        return $game
            ? strtolower(trim(strtolower($game)))
            : strtolower(trim(request('game')));
    }
}
