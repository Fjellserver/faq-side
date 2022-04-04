<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Artikler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikler', function (Blueprint $table) {
            $table->id();
            $table->longText('tittel');
            $table->longText('intro');
            $table->longText('innhold');
            $table->string('kategori');
            $table->timestamp('created_at')->useCurrent();
            $table->string('url');
            $table->boolean('hide')->default(0);
            $table->boolean('sticky')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikler');
    }
}
