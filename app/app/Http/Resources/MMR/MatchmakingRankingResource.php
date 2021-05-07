<?php

namespace App\Http\Resources\MMR;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchmakingRankingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'from' => $this->from,
            'to' => $this->to,
            'description' => $this->description
        ];
    }
}
