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
        Schema::create('users_permissions', function (Blueprint $table) {

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');

            // //FOREIGN KEY
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('permission_id')->references('id')->on('permissions');

            //PRIMARY KEYS
            $table->primary(['user_id','permission_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_permissions');
    }
};
