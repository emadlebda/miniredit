<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostVotesTable extends Migration
{
    public function up()
    {
        Schema::create('post_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('post_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->smallInteger('vote');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_votes');
    }
}
