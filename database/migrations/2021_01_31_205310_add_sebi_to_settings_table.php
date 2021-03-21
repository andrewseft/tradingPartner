<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSebiToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('planform_fee')->nullable();
            $table->integer('commission')->nullable();
            $table->integer('sebi')->nullable();
            $table->integer('sgst')->nullable();
            $table->integer('stamp_duty')->nullable();
            $table->integer('stt')->nullable();
            $table->integer('igst')->nullable();
            $table->integer('cgst')->nullable();
            $table->integer('exchange_transaction_tax')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
