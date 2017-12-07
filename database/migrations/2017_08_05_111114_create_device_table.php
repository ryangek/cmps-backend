<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->increments('device_id');
            $table->string('device_name',50);
            $table->enum('device_status', ['yes', 'no']);
            $table->enum('device_ultra', ['yes', 'no']);
            $table->decimal('device_top', 5, 3);
            $table->decimal('device_left', 5, 3);
            $table->integer('locate_id')->nullable()->unsigned();
            $table->foreign('locate_id')
                  ->references('locate_id')->on('location')
                  ->onDelete('set null');
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
        Schema::dropIfExists('device');
    }
}
