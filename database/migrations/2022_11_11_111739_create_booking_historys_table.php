<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_historys', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('user_id');
            $table->string('vehicle_id');
            $table->string('phone_no');
            $table->date('pickup_date');
            $table->date('return_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_historys');
    }
};
