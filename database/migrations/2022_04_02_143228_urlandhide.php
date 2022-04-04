<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Urlandhide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artikler', function (Blueprint $table) {
            $table->string('url');
            $table->boolean('hide')->default('0');
            $table->boolean('sticky')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artikler', function (Blueprint $table) {
            $table->string('url');
            $table->boolean('hide');
            $table->boolean('sticky');
        });
    }
}
