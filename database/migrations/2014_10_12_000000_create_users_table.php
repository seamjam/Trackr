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
        //webshop aanmaken
        Schema::create('webshops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('postcode');
            $table->string('house_number');
            $table->timestamps();
        });


        //user table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phonenumber')->nullable();
            $table->unsignedBigInteger('webshop_id')->nullable();
            $table->foreign('webshop_id')->references('id')->on('webshops');
            $table->rememberToken();
            $table->timestamps();
        });

        //roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        //userroles
        Schema::create('user_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->primary(['user_id', 'role_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });

        //package status
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('post_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        //Reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('stars')->nullable();
            $table->text('description');
            $table->timestamps();
        });


        //package
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->string('tracking_number')->nullable();
            $table->unsignedBigInteger('webshop_id')->nullable();
            $table->foreign('webshop_id')->references('id')->on('webshops')->nullabele();
            $table->unsignedBigInteger('post_company_id')->nullable();
            $table->foreign('post_company_id')->references('id')->on('post_companies')->nullabele();
            $table->unsignedBigInteger('review_id')->nullable();
            $table->foreign('review_id')->references('id')->on('reviews');
            $table->timestamps();
        });


        //reset password token table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('webshops');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('post_companies');
    }
};

