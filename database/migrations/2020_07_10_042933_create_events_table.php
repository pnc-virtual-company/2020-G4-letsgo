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
            $table->integer('numberOfMember')->default(1);
            $table->string('location');
            $table->string('title');
            $table->dateTime('startDate',0);
            $table->dateTimeTz('endDate',0);
            $table->time('startTime', 0);
            $table->time('endTime', 0);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('organizer');
            $table->string('eventPicture')->default('events.jpg');
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
