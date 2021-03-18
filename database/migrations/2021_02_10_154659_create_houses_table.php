<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->integer('floor_area');
            $table->integer('lot_area');
            $table->decimal('price',19,4);
            $table->string('street');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->integer('beds');
            $table->integer('bathroom');
            $table->string('listing_type');
            $table->integer('is_sold');
            $table->integer('agent_id');
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
        Schema::dropIfExists('houses');
    }
}
