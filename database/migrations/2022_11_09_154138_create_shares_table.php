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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
                ->constrained() // auto-detect the correct table name
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('lender_id')
                ->nullable()
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('borrower_id')
                ->nullable()
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('nonuser_lender')->nullable();
            $table->string('nonuser_borrower')->nullable();
            $table->dateTime('since')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->boolean('displayed')->default(true);
            $table->boolean('terminated')->default(false);

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
        Schema::dropIfExists('shares');
    }
};
