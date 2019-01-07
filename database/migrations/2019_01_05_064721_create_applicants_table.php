<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->integer('project_id');
            $table->integer('applicant_id');
            $table->string('motive', 1024);
            $table->string('questions', 1024);
            $table->timestamps();

            $table->primary(['project_id', 'applicant_id']);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('applicant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
