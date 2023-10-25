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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');
            $table->unsignedBigInteger('vehicle_model_id');
            $table->unsignedBigInteger('slot_pricing_id');
            $table->integer('price');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('driver_id');
            $table->string('payment_mode');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('driver_name');
            $table->unsignedBigInteger('parking_space_id');
            $table->unsignedBigInteger('parking_id');
            $table->time('entry_time')->nullable();
            $table->time('exit_time')->nullable();
            $table->date('date');
            $table->integer('number_of_peron');
            $table->integer('extra_amount')->nullable();
            $table->string('status');
            $table->integer('total_amount')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // $table->foreign('slot_id')->references('id')->on('slot');
            // $table->foreign('slot_pricing_id')->references('id')->on('slot_pricing');
            // $table->foreign('vehicale_id')->references('id')->on('vehicale_model');
            // $table->foreign('driver_id')->references('id')->on('driver');
            // $table->foreign('payment_id')->references('id')->on('payment');
            // $table->foreign('parking_space_id')->references('id')->on('parking_space');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};