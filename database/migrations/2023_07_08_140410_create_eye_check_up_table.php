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
        Schema::create('eye_check_up', function (Blueprint $table) {
            $table->id();
            $table->string('checkup_name');
            $table->unsignedBigInteger('driver_id');
            $table->timestamp('checkup_date_and_time');
            $table->string('reports');
            $table->string('other_comment');
            $table->boolean('is_active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_check_up');
    }
};
