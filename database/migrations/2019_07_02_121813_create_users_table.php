<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(){
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->softDeletes();
      $table->string('password', 100);
      $table->string('name', 255);
      $table->string('email', 255);
      $table->string('remember_token', 100)->nullable();
      $table->timestamp('email_verified_at', 100)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(){
    Schema::dropIfExists('users');
  }
}
