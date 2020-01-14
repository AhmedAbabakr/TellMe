<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('company_id');
            $table->string('company_name_en');
            $table->string('company_name_ar');
            $table->string('company_email')->unique()->nullable();
            $table->string('company_username')->unique();
            $table->string('company_password');
            $table->longText('company_address_en')->nullable();
            $table->longText('company_address_ar')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_logo');
            $table->string('company_background')->nullable();
            $table->string('company_color');
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
        Schema::dropIfExists('companies');
    }
}
