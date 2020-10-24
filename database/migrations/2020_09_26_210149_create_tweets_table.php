<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username');
            $table->string('avatar');
            $table->string('quote');
            $table->unsignedInteger('likes')->default(0);
            $table->unsignedInteger('retweets')->default(0);
            $table->unsignedInteger('comments')->default(0);
            $table->foreignId('user')->constrained()->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('tweets');
    }
}