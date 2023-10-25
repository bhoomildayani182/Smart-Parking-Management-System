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
        Schema::create('parking', function (Blueprint $table) {
            $table->id();
            $table->string('parking_name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode', 10);
            $table->string('manager_name');
            $table->bigInteger('manager_mobile_number');
            $table->string('manager_email');
            $table->string('document_number');
            $table->integer('document_file_id');
            $table->string('document_type');
            $table->string('status');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking');
    }
};
