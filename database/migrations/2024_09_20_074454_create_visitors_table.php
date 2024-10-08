<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 10)->unique();
            $table->string('name');
            $table->string('member1')->nullable();
            $table->string('member2')->nullable();
            $table->string('member3')->nullable();
            $table->string('phone')->nullable();
            $table->text('purpose');
            $table->string('photo');
            // $table->string('meet'); // Adding the whom_to_meet column
            $table->timestamp('check_in')->useCurrent();
            $table->timestamp('check_out')->nullable();
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
        Schema::dropIfExists('visitors');
    }
}
