<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('neck_size')->nullable();
            $table->float('waist_size')->nullable();
            $table->float('hips')->nullable();
            $table->string('goals')->nullable();
            $table->string('activity')->nullable();
            $table->integer('days_of_training')->nullable();
            $table->string('training_type')->nullable();
            $table->float('Water')->nullable();
            // $table->string('online')->nullable();
            $table->boolean('online')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
