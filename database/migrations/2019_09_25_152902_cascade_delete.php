<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CascadeDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('applicants');
        Schema::create('applicants', function (Blueprint $table) {
            $table->integer('project_id');
            $table->integer('applicant_id');
            $table->string('motive', 1024);
            $table->string('questions', 1024);
            $table->timestamps();

            $table->primary(['project_id', 'applicant_id']);
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
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
}
