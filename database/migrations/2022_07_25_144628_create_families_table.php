<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('father')->nullable();
            $table->unsignedBigInteger('mother')->nullable();
            $table->unsignedBigInteger('child1')->nullable();
            $table->unsignedBigInteger('child2')->nullable();
            $table->unsignedBigInteger('child3')->nullable();
            $table->unsignedBigInteger('child4')->nullable();
            $table->unsignedBigInteger('child5')->nullable();
            $table->unsignedBigInteger('child6')->nullable();
            $table->timestamps();

            $table->foreign('father')->references('id')->on('members');
            $table->foreign('mother')->references('id')->on('members');
            $table->foreign('child1')->references('id')->on('members');
            $table->foreign('child2')->references('id')->on('members');
            $table->foreign('child3')->references('id')->on('members');
            $table->foreign('child4')->references('id')->on('members');
            $table->foreign('child5')->references('id')->on('members');
            $table->foreign('child6')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}
