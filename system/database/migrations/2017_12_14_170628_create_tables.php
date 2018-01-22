<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned()->unique();
            $table->string('name');
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('api_token', 100)->unique();
            $table->string('password');
            $table->string('status');
            $table->string('license')->nullable();
            $table->string('address_data')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('location', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';

            $table->increments('locate_id')->unsigned()->unique();
            $table->string('locate_name',50);
            $table->integer('locate_floor');
            $table->integer('locate_quantity')->nullable()->default(0);
            $table->mediumText('locate_image');
            $table->timestamps();
        });

        Schema::create('device', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('device_id')->unsigned()->unique();
            $table->string('device_name',50);
            $table->enum('device_status', ['yes', 'no']);
            $table->enum('device_ultra', ['yes', 'no']);
            $table->decimal('device_top', 5, 3);
            $table->decimal('device_left', 5, 3);
            $table->integer('locate_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('locate_id')->references('locate_id')->on('location')->onDelete('set null');
        });

        Schema::create('rfid', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('rfid')->unsigned()->unique();
            $table->string('rfid_data', 12)->unique();
            $table->integer('rfid_user')->unsigned()->nullable();
            $table->integer('rfid_fixed')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('rfid_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rfid_fixed')->references('device_id')->on('device')->onDelete('set null');
        });

        Schema::create('history', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('history_id')->unsigned()->unique();
            $table->string('username', 100);
            $table->unsignedInteger('device');
            $table->unsignedInteger('location');
            $table->timestamps();

        });

        Schema::table('history', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('device')->references('device_id')->on('device')->onDelete('cascade');
            $table->foreign('location')->references('locate_id')->on('location')->onDelete('cascade');
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
        Schema::dropIfExists('location');
        Schema::dropIfExists('device');
        Schema::dropIfExists('rfid');
        Schema::dropIfExists('history');
    }
}
