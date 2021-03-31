<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('plan_id');
            $table->decimal('buy_avg', 10, 2)->nullable();
            $table->decimal('sell_avg', 10, 2)->nullable();
            $table->decimal('amount_chg', 10, 2)->nullable();
            $table->decimal('chg', 10, 2)->nullable();
            $table->decimal('qty', 10, 2)->nullable();
            $table->decimal('pl', 10, 2)->nullable();
            $table->decimal('invested', 10, 2)->nullable();
            $table->decimal('current_value', 10, 2)->nullable();
            $table->decimal('PL_balance', 10, 2)->nullable();
            $table->decimal('capital_balance', 10, 2)->nullable();
            $table->decimal('commission', 10, 2)->nullable();
            $table->decimal('platform_fee', 10, 2)->nullable();
            $table->decimal('total_commission', 10, 2)->nullable();
            $table->decimal('realised_profit', 10, 2)->nullable();
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
        Schema::dropIfExists('statements');
    }
}
