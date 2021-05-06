<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDota2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dota2s', function (Blueprint $table) {
            $table->id();
            $table->string('dota2_position_ids');
            $table->json('steam_info')->nullable();
            $table->timestamps();
        });

        Schema::table('dota2s', function($table) {
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('matchmaking_ranking_id')->constrained()->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dota2s');
    }
}
