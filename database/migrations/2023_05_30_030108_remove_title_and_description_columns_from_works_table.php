<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
        });
    }

    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('title');
            $table->text('description');
        });
    }
};
