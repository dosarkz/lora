<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->unique();
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->text('description')->nullable();
            $table->float('version')->nullable();
            $table->string('repository_url')->nullable();
            $table->boolean('installed')->default(false);
            $table->boolean('tested')->nullable();
            $table->integer('icon_id')->nullable();
            $table->integer('status_id')->default(0);
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
        Schema::dropIfExists('modules');
    }
}
