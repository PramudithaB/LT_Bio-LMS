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
    Schema::create('class_models', function (Blueprint $table) {
        $table->id();

        // Basic class details
        $table->string('className');
        $table->text('description')->nullable();
        $table->string('teacherName')->nullable();
        $table->string('classTime')->nullable();
        $table->integer('sessionCount')->nullable();
        $table->string('month')->nullable();

       

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_models');
    }
};
