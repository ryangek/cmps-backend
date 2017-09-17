<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfid', function (Blueprint $table) {
            $table->increments('rfid');
            $table->string('rfid_data', 12)->unique();
            $table->integer('rfid_user')->unsigned()->nullable();
            $table->foreign('rfid_user')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('rfid_fixed')->unsigned()->nullable();
            $table->foreign('rfid_fixed')
                ->references('device_id')->on('device')
                ->onDelete('set null');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rfid');
    }
}