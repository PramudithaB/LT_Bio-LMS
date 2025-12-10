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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
             $table->foreignId('class_id')->constrained('class_models')->onDelete('cascade');
                     $table->string('name')->nullable();

             $table->text('description')->nullable();
        $table->string('link')->nullable();
        $table->string('file_path')->nullable(); // pdf or images
        $table->text('notice')->nullable();
        $table->boolean('is_paid')->default(false);
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
