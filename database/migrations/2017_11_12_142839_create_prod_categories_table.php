<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pors', 1); // Product or Service
            $table->string('category_name', 35);
            $table->integer('parent_category_id')->unsigned();
            $table->decimal('commission_procent', 8, 2)->default(0)->unsigned()->nullable();
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
        Schema::dropIfExists('prod_categories');
    }
}
