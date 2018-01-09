<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned()->required();
            $table->integer('renter_id')->unsigned()->required();
            $table->integer('product_id')->unsigned()->required();
            $table->integer('status_id')->unsigned()->required();
            $table->boolean('loan_or_rent')->default(0)->nullable();
            $table->date('start_date')->required();
            $table->date('end_date')->required();
            $table->time('start_time')->required();
            $table->time('end_time')->required();
            $table->string('end_date_input', 60);
            $table->decimal('total_price', 8, 2)->default(0)->nullable();
            $table->decimal('deposit', 8, 2)->default(0)->nullable();
            $table->decimal('balance', 8, 2)->default(0)->nullable();
            $table->decimal('warranty_amount', 8, 2)->default(0)->nullable();
            $table->decimal('commission_procent', 8, 2)->default(0)->unsigned()->nullable();
            $table->decimal('price_hour', 8, 2)->default(0)->nullable();
            $table->decimal('price_day', 8, 2)->default(0)->nullable();
            $table->decimal('price_week', 8, 2)->default(0)->nullable();
            $table->decimal('price_month', 8, 2)->default(0)->nullable();
            $table->boolean('available_mo')->default(0)->nullable();
            $table->boolean('available_tue')->default(0)->nullable();
            $table->boolean('available_wed')->default(0)->nullable();
            $table->boolean('available_th')->default(0)->nullable();
            $table->boolean('available_fr')->default(0)->nullable();
            $table->boolean('available_sat')->default(0)->nullable();
            $table->boolean('available_sun')->default(0)->nullable();
            $table->integer('hours')->unsigned()->nullable();
            $table->integer('days')->unsigned()->nullable();
            $table->integer('weeks')->unsigned()->nullable();
            $table->integer('months')->unsigned()->nullable();
            $table->string('rent_info', 200)->nullable();
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
        Schema::dropIfExists('rentals');
    }
}
