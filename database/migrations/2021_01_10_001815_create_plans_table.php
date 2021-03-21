<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default()->nullable();
            $table->string('title')->collate('utf8_bin');
            $table->text('description')->collate('utf8_bin');
            $table->double('amount', 8, 2);
            $table->integer('qty');
            $table->integer('position')->default(1)->nullable();
            $table->boolean('status')->default(1)->comment('1=>Active,2=>Deactive');
            $table->softDeletes();
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
        Schema::dropIfExists('plans');
    }
}
