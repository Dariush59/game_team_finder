<?php

namespace App\Http\Controllers;

use App\Models\Dota2Position;
use Illuminate\Http\Request;
use App\Http\Resources\Dota2Position\Dota2PositionCollection;
use function response;

class Dota2PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Dota2Position $dota2Position)
    {
       return response(new Dota2PositionCollection($dota2Position->all()));
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
     * @param  \App\Models\Dota2Position  $dota2Position
     * @return \Illuminate\Http\Response
     */
    public function show(Dota2Position $dota2Position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dota2Position  $dota2Position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dota2Position $dota2Position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dota2Position  $dota2Position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dota2Position $dota2Position)
    {
        //
    }
}
