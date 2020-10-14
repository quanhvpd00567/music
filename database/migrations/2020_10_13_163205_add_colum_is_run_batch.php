<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumIsRunBatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('master_sites', function (Blueprint $table) {
//            $table->integer('is_run_batch')->default(0);
//        });
//        Schema::table('master_categories', function (Blueprint $table) {
//            $table->integer('is_run_batch')->default(0);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_sites', function (Blueprint $table) {
            $table->dropColumn(['is_run_batch']);
        });
        Schema::table('master_categories', function (Blueprint $table) {
            $table->dropColumn(['is_run_batch']);
        });
    }
}
