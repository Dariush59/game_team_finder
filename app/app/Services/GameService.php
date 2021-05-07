<?php
/**
 * Created by PhpStorm.
 * User: dariush
 * Date: 05/05/2021
 * Time: 9:54 PM
 */

namespace App\Services;


use App\Repositories\Dota2Repository;
use function dd;

class GameService
{
    public function create(array $request)
    {
        if (strtolower($request['game']) == 'data2')
            return (new Dota2Repository())->create( $request);

    }
}
