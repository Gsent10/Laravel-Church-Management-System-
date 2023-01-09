<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
        Schema::create('attendace_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('attendace_id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('attendace_id')->references('id')->on('attendaces');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendaces');
    }
}
