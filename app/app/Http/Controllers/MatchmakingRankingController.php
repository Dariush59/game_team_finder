<?php

namespace App\Http\Controllers;

use App\Http\Resources\MMR\MatchmakingRankingCollection;
use App\Models\MatchmakingRanking;
use Illuminate\Http\Request;

class MatchmakingRankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MatchmakingRanking $matchmakingRanking)
    {
        return new MatchmakingRankingCollection($matchmakingRanking->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchmakingRanking  $matchmakingRanking
     * @return \Illuminate\Http\Response
     */
    public function show(MatchmakingRanking $matchmakingRanking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchmakingRanking  $matchmakingRanking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatchmakingRanking $matchmakingRanking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchmakingRanking  $matchmakingRanking
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchmakingRanking $matchmakingRanking)
    {
        //
    }
}
