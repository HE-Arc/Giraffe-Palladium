<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name')->max(255);
            $table->string('email')->max(255)->unique();
            $table->string('password')->max(255);
            $table->string('password_salt')->max(255);
            $table->integer('tag');
            $table->string('information')->max(255)->nullable()->default(null);
            $table->unique(['name', 'tag']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
