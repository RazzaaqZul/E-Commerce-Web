<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('email', 255)->nullable(false)->unique("users_email_unique");
            $table->string('username', 32)->nullable(false)->unique("users_username_unique");
            $table->char('password', 60)->nullable(false);
            $table->string('fullname', 255)->nullable(false);
            $table->enum('gender',['male', 'female'])->nullable(false)->default('male');
            $table->char('remember_token', 100)->nullable(true);
            $table->string('address', 255)->nullable(false);
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
};
