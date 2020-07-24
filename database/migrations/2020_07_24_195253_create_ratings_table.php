<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->float('score');
            $table->nullableMorphs('rateable');
            $table->nullableMorphs('qualifier');
            $table->timestamps();

            /*
                Equivalente a
                $table->unsignedBigInteger('rateable_id');
                $table->string('rateable_type');

                $table->integer('qualifier_id');
                $table->string('qualifier_type');
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}