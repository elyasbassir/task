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
            $table->integer('id', true);
            $table->text('name');
            $table->text('phone');
            $table->text('password');
            $table->integer('level');
            $table->text('token');
            $table->text('grade');
            $table->boolean('active');
            $table->text('updated_at');
            $table->text('created_at');
            $table->text('remember_token');
            $table->text('image_access');
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
