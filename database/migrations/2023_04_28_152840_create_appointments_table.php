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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id', 'scheduled_for')->references('id')->on('users');
            $table->foreign('user_id', 'created_by')->references('id')->on('users');
            $table->foreignId('incident_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('appointment_type_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
