<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the department_id column
            $table->unsignedBigInteger('department_id')->nullable()->after('email');
            
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
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key constraint and the department_id column
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
}
