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
            $table->id();
            $table->unsignedBigInteger('inviter_id')->nullable()->default(null);

            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('delete_after')->nullable();
            $table->timestamp('disabled_on')->nullable();

            $table->string('locale')->default(config('app.locale'));
            $table->string('profile_photo_url')->nullable()->default(null);

            $table->string('display_name');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->enum('role',  ['evaluator', 'user', 'moderator', 'admin'])->default('evaluator');
            $table->string('password');
            $table->rememberToken();

            $table->foreign('inviter_id')->references('id')->on('users');
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
