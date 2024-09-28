<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDepartmentAndMeetUserToVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // $table->unsignedBigInteger('department_id')->nullable()->after('phone');
            $table->unsignedBigInteger('meet_user_id')->nullable()->after('phone');
        });

        // Clean up invalid data
        // DB::table('visitors')
        //     ->whereNotIn('department_id', function($query) {
        //         $query->select('id')->from('departments');
        //     })
        //     ->update(['department_id' => null]);

        DB::table('visitors')
            ->whereNotIn('meet_user_id', function($query) {
                $query->select('id')->from('users');
            })
            ->update(['meet_user_id' => null]);

        // Now add foreign key constraints
        Schema::table('visitors', function (Blueprint $table) {
            // $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('meet_user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // $table->dropForeign(['department_id']);
            $table->dropForeign(['meet_user_id']);
            $table->dropColumn([ 'meet_user_id']);
        });
    }
}