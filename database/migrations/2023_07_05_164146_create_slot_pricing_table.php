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
        Schema::create('slot_pricing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');
            $table->unsignedBigInteger('vehicle_model_id');
            $table->integer('price');
            $table->string('day', 10);
            $table->bigInteger('created_by')->nullable()->nullable();
            $table->bigInteger('updated_by')->nullable()->nullable();
            $table->bigInteger('deleted_by')->nullable()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('slot_id')->references('id')->on('slot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_pricing');
    }
};