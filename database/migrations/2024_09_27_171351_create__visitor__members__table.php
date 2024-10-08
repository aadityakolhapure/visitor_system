<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        

        // Create new visitor_members table
        Schema::create('visitor_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitor_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_members');

      
    }
};
