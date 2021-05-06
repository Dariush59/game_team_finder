<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->morphs('gameable');
            $table->timestamps();
        });

        Schema::table('games', function($table) {
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('games');
    }
}
