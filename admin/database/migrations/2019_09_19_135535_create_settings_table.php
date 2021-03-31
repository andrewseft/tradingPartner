<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('email', 100)->unique()->collate('utf8_bin');
            $table->string('support_email', 100)->unique()->collate('utf8_bin');
            $table->string('number', 15);
            $table->string('name', 125)->collate('utf8_bin');
            $table->text('address')->collate('utf8_bin');
            $table->text('copy_right')->collate('utf8_bin');
            $table->integer('platform_commission')->default(10);;
            $table->integer('admin_limit')->default(10);
            $table->integer('front_limit')->default(10);
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
        Schema::dropIfExists('settings');
    }
}
