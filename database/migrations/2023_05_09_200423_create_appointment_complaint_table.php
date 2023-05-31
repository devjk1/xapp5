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
        Schema::create('appointment_complaint', function (Blueprint $table) {
            $table->primary(['appointment_id', 'complaint_id']);
            $table->foreignId('appointment_id')->constrained();
            $table->foreignId('complaint_id')->constrained();
            $table->unsignedTinyInteger('level');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_complaint');
    }
};
