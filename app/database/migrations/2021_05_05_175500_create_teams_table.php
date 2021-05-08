<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('game_name');
            $table->json('position_ids');
            $table->integer('rank');
            $table->boolean('is_complete');
            $table->unsignedTinyInteger('free_spot');
            $table->timestamps();
        });

        Schema::table('teams', function($table) {
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('teams');
    }
}
