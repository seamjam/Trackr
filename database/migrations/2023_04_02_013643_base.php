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
            $table->timestamps();
            $table->index(['name'], 'webshops_name_fulltext');
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
            $table->boolean('is_admin');
            $table->string('receiver_postal_code')->nullable();
            $table->string('receiver_house_number')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->index(['name', 'email', 'phonenumber', 'webshop_id'], 'users_fulltext_index');
        });

        //roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->index(['name'], 'roles_name_fulltext');
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
            $table->index(['name'], 'statuses_name_fulltext');
        });

        Schema::create('post_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->index(['name'], 'post_companies_name_fulltext');
        });

        //Reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('stars')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->index(['description'], 'reviews_description_fulltext');
        });

        //pickuprequests
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('postal_code');
            $table->string('house_number');
            $table->timestamps();
            $table->index(['date', 'postal_code', 'house_number'], 'pickuprequest_fulltext');
       });

        //package
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->string('tracking_number')->unique();
            $table->unsignedBigInteger('webshop_id')->nullable();
            $table->foreign('webshop_id')->references('id')->on('webshops')->nullable();
            $table->unsignedBigInteger('post_company_id')->nullable();
            $table->foreign('post_company_id')->references('id')->on('post_companies')->nullable();
            $table->unsignedBigInteger('review_id')->nullable();
            $table->foreign('review_id')->references('id')->on('reviews')->nullable();
            $table->unsignedBigInteger('pickup_request_id')->nullable();
            $table->foreign('pickup_request_id')->references('id')->on('pickup_requests')->nullable();
            $table->string('receiver_firstname')->nullable();
            $table->string('receiver_lastname')->nullable();
            $table->string('receiver_postal_code')->nullable();
            $table->string('receiver_house_number')->nullable();
            $table->timestamps();
            $table->index(['tracking_number', 'receiver_firstname', 'receiver_lastname'], 'packages_fulltext_index');
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
        Schema::dropIfExists('pickup_requests');
    }
};
