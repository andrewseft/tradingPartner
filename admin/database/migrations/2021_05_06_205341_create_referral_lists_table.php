<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('month');
            $table->string('month_name');
            $table->integer('account_converted');
            $table->integer('trade_active');
            $table->integer('flat_income');
            $table->integer('gross_brokerage');
            $table->integer('net_sharing');
            $table->integer('total');
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
        Schema::dropIfExists('referral_lists');
    }
}
