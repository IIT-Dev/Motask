<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendUsersField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('line')->default('-');
            $table->string('phone')->default('-');
            $table->string('linkedin')->default('-');
            $table->string('git')->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('line');
            $table->dropColumn('phone');
            $table->dropColumn('linkedin');
            $table->dropColumn('git');
        });
    }
}
