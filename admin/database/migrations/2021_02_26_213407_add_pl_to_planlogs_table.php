<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlToPlanlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planlogs', function (Blueprint $table) {
            $table->decimal('pl', 10, 2)->default(0);
            $table->integer('type')->default(0);
            $table->integer('pl_p')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planlogs', function (Blueprint $table) {
            //
        });
    }
}
