<?php

namespace App\Repositories;


use Illuminate\Support\Facades\Http;

class DiscordAuthRepository
{
    private $token = null;

    public function user(){
        return $this->setToken()->getUserInfo()->user;
    }

    public function setToken()
    {
        $token = $this->getAuthToken();
        if (isset($token->error))
            throw new \Exception($token->error);

        $this->token = $token->access_token;
        return $this;
    }

    protected function getAuthToken()
    {

        if (!request()->has('code') && !request()->has('state'))
            throw new \Exception('code or state has been missed');
        return json_decode(Http::asForm()->post(env('DISCORD_OAUTH_URI'), [
            "grant_type" => "authorization_code",
            "client_id" => env('DISCORD_CLIENT_ID'),
            "client_secret" => env('DISCORD_CLIENT_SECRET'),
            "redirect_uri" => env('DISCORD_REDIRECT_URI'),
            "code" => request('code'),
            "state" => request('state')
        ]));
    }

    protected function getUserInfo() {
        if ($this->token)
            return json_decode(Http::withToken($this->token)
                ->get(env('DISCORD_USER_URI')));
    }
}