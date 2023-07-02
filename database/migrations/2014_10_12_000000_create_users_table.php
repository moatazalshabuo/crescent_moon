<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',35);
            $table->string('email',120)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean("status")->default(0);
            $table->tinyInteger("type_user");
            $table->string("username",25)->unique();
            $table->integer("count_family")->nullable();
            $table->string('password');
            $table->string("address",150);
            $table->string("phone",40);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
