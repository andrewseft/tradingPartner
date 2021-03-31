<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->comment('1=>Admin,2=>SubAdmin,3=>User');
            $table->string('token')->nullable();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50);
            $table->string('number', 15)->nullable();
            $table->string('username')->nullable();
            $table->string('image', 50)->nullable();
            $table->string('password');
            $table->boolean('status')->default(1)->comment('1=>Active,2=>Deactive');
            $table->boolean('notification')->default(1)->comment('1=>On,2=>Off');
            $table->boolean('online')->default(0)->comment('1=>On,2=>Off');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('social_id')->nullable();
            $table->integer('investmentCapital')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->enum('language', ['en'])->default('en');
            $table->longText('address')->nullable();
            $table->longText('device_token')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
