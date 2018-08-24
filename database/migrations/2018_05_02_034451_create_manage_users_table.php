<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manage_role_id');
            $table->string('email', 320);
            $table->string('password');
            $table->string('user_last_name', 100)->nullable();
            $table->string('user_first_name', 100)->nullable();
            $table->string('reminder_token', 100)->nullable();
            $table->timestamp('reminder_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_users');
    }
}
