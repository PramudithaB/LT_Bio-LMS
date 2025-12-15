<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            // add class relation and unique constraint so one package maps to a single class
            $table->foreignId('class_id')->nullable()->after('id')->constrained('class_models')->nullOnDelete();
            $table->unique('class_id');
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropUnique(['class_id']);
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });
    }
};
