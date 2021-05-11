<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
// It has to be a service
class DiscordAuthService
{
    private $token = null;

    public function user(){
        return $this->setToken()->getUserInfo()->user;
    }

    public function setToken()
    {
        $token = $this->getTokenFromDiscord();
        if (isset($token->error))
            throw new \Exception($token->error);

        $this->token = $token->access_token;
        return $this;
    }

    protected function getTokenFromDiscord()
    {
        if (!request('code')&& !request('state'))
            throw new \Exception('code or state has been missed');
        return json_decode(Http::asForm()->post(env('DISCORD_OAUTH_URI'), $this->discordData()));
    }

    protected function getUserInfo() {
        if ($this->token)
            return json_decode(Http::withToken($this->token)
                ->get(env('DISCORD_USER_URI')));
    }

    private function discordData()
    {
        return [
            "grant_type" => "authorization_code",
            "client_id" => env('DISCORD_CLIENT_ID'),
            "client_secret" => env('DISCORD_CLIENT_SECRET'),
            "redirect_uri" => env('DISCORD_REDIRECT_URI'),
            "code" => request('code'),
            "state" => request('state')
        ];
    }
}