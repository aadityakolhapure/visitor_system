<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Add the department_id column
            $table->unsignedBigInteger('department_id')->nullable()->after('phone');
            
            // Set up the foreign key constraint
            $table->foreign('department_id')->references('id')->on('department')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Drop the foreign key constraint and the department_id column
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
};
