<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->float('nilai')->nullable();
            $table->timestamps();

            $table->foreign('alternatif_id')
                ->references('id')->on('alternatif')
                ->onDelete('cascade');

            $table->foreign('kriteria_id')
                ->references('id')->on('kriteria')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bobot');
    }
}
