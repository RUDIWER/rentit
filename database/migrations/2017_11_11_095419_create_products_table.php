<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->required();
            $table->float('geo_latitude',10,6)->default(0)->nullable();
            $table->float('geo_longitude',10,6)->default(0)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('pors')->unsigned()->required();;
            $table->integer('group')->unsigned()->required();;
            $table->integer('category')->unsigned()->required();;
            $table->integer('sub_category')->unsigned()->required();;
            $table->string('title',60);
            $table->string('sub_title',60);
            $table->string('description',200);
            $table->decimal('price_hour',8,2)->default(0)->unsigned()->nullable();
            $table->decimal('price_day',8,2)->default(0)->unsigned()->nullable();
            $table->decimal('price_week',8,2)->default(0)->unsigned()->nullable();
            $table->decimal('price_month',8,2)->default(0)->unsigned()->nullable();
            $table->boolean('is_warranty')->default(0)->nullable();
            $table->decimal('warranty_amount',8,2)->default(0)->unsigned()->nullable();
            $table->string('warranty_description',200)->nullable();
            $table->boolean('available_mo')->default(0)->nullable();
            $table->boolean('available_tue')->default(0)->nullable();
            $table->boolean('available_wed')->default(0)->nullable();
            $table->boolean('available_th')->default(0)->nullable();
            $table->boolean('available_fr')->default(0)->nullable();
            $table->boolean('available_sat')->default(0)->nullable();
            $table->boolean('available_sun')->default(0)->nullable();
            $table->boolean('rent_belgium')->default(0)->nullable();
            $table->boolean('rent_netherlands')->default(0)->nullable();
            $table->boolean('is_home_delivery')->default(0)->nullable();
            $table->decimal('home_delivery_amount',8,2)->default(0)->unsigned()->nullable();
            $table->string('home_delivery_description',100)->nullable();
            $table->string('picture_1')->nullable();
            $table->string('picture_2')->nullable();
            $table->string('picture_3')->nullable();
            $table->string('picture_4')->nullable();
            $table->string('picture_5')->nullable();
            $table->string('picture_6')->nullable();
            $table->string('picture_7')->nullable();
            $table->string('picture_8')->nullable();
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
        Schema::dropIfExists('products');
    }
}
