<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chain_id')->unsigned();
            $table->boolean('validated')->default(0);
            $table->boolean('unread')->default(1);
            $table->string('message', 500);
            $table->string('title', 100);
            $table->integer('sender_id')->unsigned();
            $table->integer('receiver_id')->unsigned();
            $table->string('sender_nickname');
            $table->string('receiver_nickname');
            $table->timestamps();
        });
    }

    /**&a²
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
