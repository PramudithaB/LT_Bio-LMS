<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Attempt to drop the unique index; ignore if it does not exist
        try {
            DB::statement('ALTER TABLE `feedback` DROP INDEX `feedback_email_unique`');
        } catch (\Exception $e) {
            // index may not exist — safe to ignore
        }
    }

    public function down(): void
    {
        // Recreate the unique index (this will fail if duplicate emails already exist)
        Schema::table('feedback', function (Blueprint $table) {
            $table->unique('email');
        });
    }
};
