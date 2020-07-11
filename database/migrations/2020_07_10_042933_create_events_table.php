<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('numberOfMember');
            $table->string('location');
            $table->dateTime('startDate',0);
            $table->dateTimeTz('endDate',0);
            $table->string('description');
            $table->unsignedBigInteger('organizer');
            $table->foreign('organizer')
                  ->references('id')
                  ->on('users')
                 ->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                 ->references('id')
                 ->on('categories')
                 ->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}
