<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chain_id')->unsigned()->unique();
            $table->boolean('validated')->default(0);
            $table->boolean('unread')->default(1);
            $table->string('title', 40);
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
        Schema::dropIfExists('message_headers');
    }
}
