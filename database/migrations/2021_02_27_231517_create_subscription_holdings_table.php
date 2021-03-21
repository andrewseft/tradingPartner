<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionHoldingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_holdings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('plan_id');
            $table->decimal('qty', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('totalAmount', 10, 2)->nullable();
            $table->decimal('pl', 10, 2)->nullable();
            $table->decimal('commission', 10, 2)->nullable();
            $table->decimal('platform_fee', 10, 2)->nullable();
            $table->decimal('total_tax', 10, 2)->nullable();
            $table->decimal('total_commission', 10, 2)->nullable();
            $table->decimal('expense', 10, 2)->nullable();
            $table->decimal('realised_profit', 10, 2)->nullable();
            $table->decimal('profit_change', 10, 2)->nullable();
            $table->boolean('is_pay')->default(0)->comment('0=>No,1=>Yes');
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
        Schema::dropIfExists('subscription_holdings');
    }
}
