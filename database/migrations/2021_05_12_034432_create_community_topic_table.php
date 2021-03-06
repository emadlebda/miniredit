<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityTopicTable extends Migration
{
    public function up()
    {
        Schema::create('community_topic', function (Blueprint $table) {
            $table->foreignId('community_id')->constrained();
            $table->foreignId('topic_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_topic');
    }
}
