<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_answers', function (Blueprint $table) {
            $table->bigIncrements('review_answer_id');
            $table->integer('branch_id')->index();
            $table->integer('question_id')->index();
            $table->integer('option_id')->index()->nullable();
            $table->string('option_text')->nullable();
            $table->integer('company_id')->index();
            $table->integer('review_id')->index();
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
        Schema::dropIfExists('review_answers');
    }
}
