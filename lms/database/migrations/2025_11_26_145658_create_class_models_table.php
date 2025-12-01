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

        // ------------------------------------------
        // Week 1 – Week 5 fields
        // ------------------------------------------
        for ($i = 1; $i <= 4; $i++) {
            $table->string("week{$i}Name")->nullable();
            $table->text("week{$i}Desc")->nullable();
            $table->text("week{$i}LongDesc")->nullable();
            $table->string("week{$i}Link")->nullable();
            $table->text("specialNoticeW{$i}")->nullable();
            $table->json("week{$i}Files")->nullable(); // store PDFs/images as JSON array
        }

        // ------------------------------------------
        // Special Class fields
        // ------------------------------------------
        $table->string('specialClassName')->nullable();
        $table->text('specialClassDesc')->nullable();
        $table->text('specialClassLongDesc')->nullable();
        $table->string('specialClassLink')->nullable();
        $table->text('specialNoticeSC')->nullable();
        $table->json('specialClassFiles')->nullable();

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
