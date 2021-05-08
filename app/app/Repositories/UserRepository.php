<?php

namespace App\Repositories;


use App\Models\User;
use function array_merge;
use function collect;

class UserRepository
{

    public function __construct(User $user = null)
    {
        $this->user = $user ?? new User;
    }

    public function create(array $request){
        return $this->user->create($request);
    }
}