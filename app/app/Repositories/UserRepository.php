<?php

namespace App\Repositories;


use App\Models\Dota2;
use App\Models\User;
use function array_merge;
use function collect;
use function dd;
use Illuminate\Support\Facades\Http;
use function PHPSTORM_META\map;

class UserRepository
{

    public function __construct(User $user = null)
    {
        $this->user = $user ?? new User;
    }

    public function create(array $request){
        $position_ids= collect($request['position_ids'])->map(function ($position){
            return $position['id'];
        })->toJson();
        return $this->user->create(array_merge($request, ['position_ids' => $position_ids]));

    }
}