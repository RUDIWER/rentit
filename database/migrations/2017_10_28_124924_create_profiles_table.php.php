<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('picture');
            $table->string('first_name',30)->nullable();
            $table->string('last_name',40)->nullable();
            $table->date('birthday')->nullable();
            $table->string('nationality',40)->nullable();
            $table->string('addr1_street',50)->nullable();
            $table->string('addr1_housenr',5)->nullable();
            $table->string('addr1_bus',5)->nullable();
            $table->string('addr1_postcode',15)->nullable();
            $table->string('addr1_city',50)->nullable();
            $table->string('addr1_country',60)->nullable();
            $table->float('geo_latitude',10,6)->default(0)->nullable();
            $table->float('geo_longitude',10,6)->default(0)->nullable();
            $table->string('geo_address',150)->nullable();
            $table->string('geo_country_name',80)->nullable();
            $table->string('geo_country_code',10)->nullable();
            $table->string('geo_provider',40)->nullable();      
            $table->string('phone_1',20)->nullable();
            $table->string('mobile_1',20)->nullable();
            $table->string('fax_1',20)->nullable();
            $table->boolean('company')->default(0)->unsigned();
            $table->string('company_name',55)->nullable();
            $table->string('vat_number',20)->nullable();
            $table->string('company_addr_street',50)->nullable();
            $table->string('company_addr_housenr',5)->nullable();
            $table->string('company_addr_bus',5)->nullable();
            $table->string('company_addr_postcode',15)->nullable();
            $table->string('company_addr_city',50)->nullable();
            $table->string('company_addr_country',60)->nullable();
            $table->string('avatar',60)->nullable();
            $table->boolean('newsletter')->default(0)->unsigned();
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
         Schema::dropIfExists('profile');
    }

}
