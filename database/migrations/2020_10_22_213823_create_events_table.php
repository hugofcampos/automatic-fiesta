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
            $table->uuid('uuid');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->boolean('published')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('event_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->boolean('active')->default(false);
            $table->dateTimeTz('starts_at', 0);
            $table->dateTimeTz('ends_at', 0)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')->references('id')->on('events');
            $table->index('starts_at');
            $table->index('ends_at');
            $table->index('active');
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
