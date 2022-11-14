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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company');
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("phone");
            $table->text("notes")->nullable();
            $table->timestamps();
        });

        //Schema::rename('contacts1', 'contacts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
