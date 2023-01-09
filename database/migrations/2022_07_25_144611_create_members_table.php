<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('surname');
            $table->string('middle_name')->nullable()->default(NULL);
            $table->string('birthday')->nullable()->default(NULL);
            $table->string('state');
            $table->string('lga');
            $table->string('address');
            $table->string('phone')->nullable()->default(NULL);
            $table->string('img_path');
            $table->unsignedBigInteger('cell_id')->nullable()->default(NULL);
            $table->timestamps();

            $table->foreign('cell_id')->references('id')->on('cells');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
