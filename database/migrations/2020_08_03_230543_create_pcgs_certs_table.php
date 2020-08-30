<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcgsCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcgs_certs', function (Blueprint $table) {
            $table->id();
            $table->integer('cert_range_start')->unique();
            $table->integer('cert_range_end')->unique()->nullable();
            $table->date('date_range_start');
            $table->date('date_range_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcgs_certs');
    }
}
