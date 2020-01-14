<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->bigIncrements('option_id');
            $table->integer('question_id')->index();
            $table->string('option_text_en')->nullable();
            $table->string('option_text_ar')->nullable();
            $table->string('option_image')->nullable();
            $table->integer('option_type')->nullable();
            $table->string('option_made_by')->index();
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
        Schema::dropIfExists('question_options');
    }
}
