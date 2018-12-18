<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
			$table->increments('id');
			$table->string('icao')->nullable();
			$table->string('identifier');
			$table->string('name');
			$table->string('city');
			$table->string('county');
			$table->string('state');
			$table->float('latitude');
			$table->float('longitude');
			$table->float('elevation');
			$table->string('type');
			$table->boolean('has_control_tower');
			$table->boolean('has_precision_approach')->default(false);
			$table->boolean('has_non_precision_approach')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
