<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_last_name');
            $table->string('second_last_name')->nullable();
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('gender',['Masculino','Femenino']);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->unsignedBigInteger('profile_id')->nullable();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('SET NULL');
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
        Schema::dropIfExists('clients');
    }
}
