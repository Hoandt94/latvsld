<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->integer('set_question_id')->unsigned();
            $table->foreign('set_question_id')->references('id')->on('set_questions')->onDelete('cascade');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('assessment_id')->unsigned();
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade');
            $table->string('answer');

            //yes
            $table->text('yes_note')->nullable();
            $table->string('yes_attachment')->nullable();

            //no
            $table->integer('no_employee_id')->unsigned()->nullable();
            $table->foreign('no_employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('no_finish_date')->nullable();

            //improve
            $table->text('improve_note')->nullable();
            $table->string('improve_attachment')->nullable();
            $table->integer('improve_employee_id')->unsigned()->nullable();
            $table->foreign('improve_employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('improve_finish_date')->nullable();

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
        Schema::dropIfExists('survey_results');
    }
}
