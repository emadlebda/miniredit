<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToCommunitiesTable extends Migration
{
    public function up()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
    }

    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
