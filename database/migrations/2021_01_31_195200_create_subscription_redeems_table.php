<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionRedeemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_redeems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('amount', 10, 2);
            $table->integer('plan_id');
            $table->integer('qty');
            $table->string('remark')->nullable();
            $table->integer('status')->nullable();
            $table->integer('type')->comment('1=>Buy,2=>Redeem');
            $table->double('realized',8, 2)->nullable();
            $table->double('planform_fee',8, 2)->nullable();
            $table->double('commission',8, 2)->nullable();
            $table->double('sebi',8, 2)->nullable();
            $table->double('sgst',8, 2)->nullable();
            $table->double('stamp_duty',8, 2)->nullable();
            $table->double('stt',8, 2)->nullable();
            $table->double('igst',8, 2)->nullable();
            $table->double('cgst',8, 2)->nullable();
            $table->double('exchange_transaction_tax',8, 2)->nullable();
            $table->double('total_charges',8, 2)->nullable();
            $table->double('final_pl',8, 2)->nullable();
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
        Schema::dropIfExists('subscription_redeems');
    }
}
