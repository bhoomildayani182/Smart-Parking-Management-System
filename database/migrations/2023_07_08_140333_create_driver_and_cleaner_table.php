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
        Schema::create('driver_and_cleaner', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('mobile');
            $table->string('email_ID')->nullable();
            $table->string('Gender');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode', 10)->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->unsignedBigInteger('document_file_id')->nullable();
            $table->string('designation');
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
        Schema::dropIfExists('driver_and_cleaner');
    }
};
