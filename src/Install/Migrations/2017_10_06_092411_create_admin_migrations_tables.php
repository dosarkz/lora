<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMigrationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function(Blueprint $table){
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->integer('role_id');
            $table->integer('user_id')->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('alias')->unique();
            $table->integer('parent_role_id')->nullable();
            $table->integer('status_id')->nullable();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('alias', 50);
            $table->string('http_method')->nullable();
            $table->text('http_path');
            $table->timestamps();
        });

        Schema::create('admin_user_roles', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('admin_user_id');
            $table->index(['role_id', 'admin_user_id']);
            $table->timestamps();
        });

        Schema::create('admin_user_permissions', function (Blueprint $table) {
            $table->integer('admin_user_id');
            $table->integer('permission_id');
            $table->index(['admin_user_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('thumb');
            $table->string('path');
            $table->integer('status_id')->nullable();
            $table->timestamps();
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
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
        //
    }
}
