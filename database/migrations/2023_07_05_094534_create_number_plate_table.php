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
        Schema::create('number_plate', function (Blueprint $table) {
            $table->id();
            $table->string('group_of_letter');
            $table->unsignedBigInteger('state_id');
            $table->string('state_name');
            $table->unsignedBigInteger('city_id');
            $table->string('city_name');
            $table->string('city_number');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numberplate');
    }
};
